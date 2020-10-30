<?php

namespace App\Repositories;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;
use GuzzleHttp\Exception\ClientException;

class UserRepository {
    const SUCCUSUS_STATUS_CODE = 200;
    const UNAUTHORISED_STATUS_CODE = 401;
    const UNAUTHORISED_STATUS_TEXT = 'Unauthorised';
    const REFRESHTOKEN_HEADER = 'Refreshtoken';
    private $http;
    private $BASE_URL;

    public function __construct(Client $client) {
        $this->http = $client;
        $this->BASE_URL = config('app.url').'/';
    }

    public function login(Request $request) {
        $login = $request->login;
        $password = $request->password;

        if (Auth::attempt(['login' => $login, 'password' => $password])) {
            $response = $this->getTokenAndRefreshToken($login, $password);
            $data = $response["data"];
            $statusCode = $response["statusCode"];
        } else {
            $data = ['error' => self::UNAUTHORISED_STATUS_TEXT];
            $statusCode = self::UNAUTHORISED_STATUS_CODE;
        }

        return $this->response($data, $statusCode);
    }

    public function refreshToken(Request $request) {
        if (is_null($request->header(self::REFRESHTOKEN_HEADER))) {
            return $this->response(['error' => self::UNAUTHORISED_STATUS_TEXT], self::UNAUTHORISED_STATUS_CODE);
        }

        $refresh_token = $request->header(self::REFRESHTOKEN_HEADER);
        $Oclient = $this->getOClient();
        $formParams = ['grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token,
            'client_id' => $Oclient->id,
            'client_secret' => $Oclient->secret,
            'scope' => '*'];

        return $this->sendRequest("/oauth/token", $formParams);
    }

    public function user() {
        $user = Auth::user();
        return $this->response($user, self::SUCCUSUS_STATUS_CODE);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return $this->response(['message' => 'Successfully logged out'], self::SUCCUSUS_STATUS_CODE);
    }

    public function response($data, int $statusCode) {
        $response = ["data" => $data, "statusCode" => $statusCode];
        return $response;
    }

    public function getTokenAndRefreshToken(string $login, string $password) {
        $Oclient = $this->getOClient();
        $formParams = ['grant_type' => 'password',
            'client_id' => $Oclient->id,
            'client_secret' => $Oclient->secret,
            'username' => $login,
            'password' => $password,
            'scope' => '*'];

        return $this->sendRequest("/oauth/token", $formParams);
    }

    public function sendRequest(string $route, array $formParams) {
        try {
            $url = $this->BASE_URL.$route;
            $response = $this->http->request('POST', $url, ['form_params' => $formParams]);

            $statusCode = self::SUCCUSUS_STATUS_CODE;
            $data = json_decode((string) $response->getBody(), true);
        } catch (ClientException $e) {
            echo $e->getMessage();
            $statusCode = $e->getCode();
            $data = ['error' => 'OAuth client error'];
        }

        return ["data" => $data, "statusCode" => $statusCode];
    }

    public function getOClient() {
        return OClient::where('password_client', 1)->first();
    }
}
