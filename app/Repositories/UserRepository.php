<?php

namespace App\Repositories;

use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class UserRepository extends BaseRepository {
    public function login(Request $request) {
        $username = $request->username;
        $password = $request->password;
        $device_name = $request->device_name;

        $user = User::where('login', $username)->first();
        if (!$user || !Hash::check($password, $user->password)) {
            $data = ['error' => self::UNAUTHORISED_STATUS_TEXT];
            $statusCode = self::UNAUTHORISED_STATUS_CODE;
            return $this->response($data, $statusCode);
        }

        $data = ['access_token' => $user->createToken($device_name)->plainTextToken, 'expires_in' => config('sanctum.expiration') * 60];
        $statusCode = self::SUCCUSUS_STATUS_CODE;
        return $this->response($data, $statusCode);
    }

    public function user(Request $request) {
        $user = User::query()
            ->select(['users.*', 'roles.name as role', 'groups.name as group', 'faculties.name as faculty'])

            ->join('user_roles', 'users.id', '=', 'user_roles.user_id')
            ->join('roles', 'user_roles.role_id', '=', 'roles.id')

            ->join('user_groups', 'users.id', '=', 'user_groups.user_id', 'left')
            ->join('groups', 'user_groups.group_id', '=', 'groups.id', 'left')
            ->join('faculties', 'groups.faculty_id', '=', 'faculties.id', 'left')

            ->where('users.id', '=', $request->user()->id)
            ->first();
        return $this->response($user, self::SUCCUSUS_STATUS_CODE);
    }

    public function refreshToken(Request $request) {
        $currentAccessToken = $request->user()->currentAccessToken();
        $device_name = $currentAccessToken->name;
        $currentAccessToken->delete();

        $data = ['access_token' => $request->user()->createToken($device_name)->plainTextToken, 'expires_in' => config('sanctum.expiration') * 60];
        $statusCode = self::SUCCUSUS_STATUS_CODE;
        return $this->response($data, $statusCode);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
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
}
