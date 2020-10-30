<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Repositories\UserRepository;

class UserController extends Controller {
    const SUCCUSUS_STATUS_CODE = 200;
    const UNAUTHORISED_STATUS_CODE = 401;

    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login(UserLoginRequest $request) {
        $response = $this->userRepository->login($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function user() {
        $response = $this->userRepository->user();
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function logout(Request $request) {
        $response = $this->userRepository->logout($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function refreshToken(Request $request) {
        $response = $this->userRepository->refreshToken($request);
        return response()->json($response["data"], $response["statusCode"]);
    }
}
