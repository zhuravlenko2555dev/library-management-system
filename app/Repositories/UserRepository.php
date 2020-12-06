<?php

namespace App\Repositories;

use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\Client as OClient;
use GuzzleHttp\Exception\ClientException;
use DB;

class UserRepository extends BaseRepository {
    private $http;
    private $BASE_URL;

    public function __construct(Client $client) {
        $this->http = $client;
        $this->BASE_URL = config('app.url').'/';
    }

    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;

        if (Auth::attempt(['login' => $username, 'password' => $password])) {
            $response = $this->getTokenAndRefreshToken($username, $password);
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
        $user = User::query()
            ->select(['users.*', 'roles.name as role', 'groups.name as group', 'faculties.name as faculty'])

            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')

            ->join('user_groups', 'users.id', '=', 'user_groups.user_id', 'left')
            ->join('groups', 'user_groups.group_id', '=', 'groups.id', 'left')
            ->join('faculties', 'groups.faculty_id', '=', 'faculties.id', 'left')

            ->where('users.id', '=', Auth::user()->id)
            ->first();
        return $this->response($user, self::SUCCUSUS_STATUS_CODE);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return $this->response(['message' => 'Successfully logged out'], self::SUCCUSUS_STATUS_CODE);
    }

    public function readersCount() {
        $readersCount = DB::table('users')
            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')
            ->where('roles.id', '=', 3)
            ->count();

        return $this->response($readersCount, self::SUCCUSUS_STATUS_CODE);
    }

    public function readersActive() {
        $active = User::query()
            ->select(['users.*', DB::raw('count(borrowed_books.id) as borrowed_books')])
            ->join('borrowed_books', 'users.id', '=', 'borrowed_books.borrower_id')
            ->groupBy('users.id')
            ->orderBy('borrowed_books', 'desc')
            ->limit(10)
            ->get();

        return $this->response($active, self::SUCCUSUS_STATUS_CODE);
    }

    public function getTokenAndRefreshToken(string $username, string $password) {
        $Oclient = $this->getOClient();
        $formParams = ['grant_type' => 'password',
            'client_id' => $Oclient->id,
            'client_secret' => $Oclient->secret,
            'username' => $username,
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
//            echo $e->getMessage();
            $statusCode = $e->getCode();
            $data = ['error' => 'OAuth client error'];
        }

        return ["data" => $data, "statusCode" => $statusCode];
    }

    public function getOClient() {
        return OClient::where('password_client', 1)->first();
    }
}
