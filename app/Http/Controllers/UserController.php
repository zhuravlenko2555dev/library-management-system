<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserLoginRequest;
use App\Repositories\UserRepository;

class UserController extends Controller {
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function login(UserLoginRequest $request) {
        $response = $this->userRepository->login($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function user(Request $request) {
        $response = $this->userRepository->user($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function refreshToken(Request $request) {
        $response = $this->userRepository->refreshToken($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function logout(Request $request) {
        $response = $this->userRepository->logout($request);
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function readersCount() {
        $response = $this->userRepository->readersCount();
        return response()->json($response["data"], $response["statusCode"]);
    }

    public function readersActive() {
        $response = $this->userRepository->readersActive();
        return response()->json($response["data"], $response["statusCode"]);
    }
}
