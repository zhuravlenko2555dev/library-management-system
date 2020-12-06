<?php


namespace App\Repositories;


class BaseRepository {
    protected const SUCCUSUS_STATUS_CODE = 200;
    protected const UNAUTHORISED_STATUS_CODE = 401;
    protected const UNAUTHORISED_STATUS_TEXT = 'Unauthorised';
    protected const REFRESHTOKEN_HEADER = 'Refreshtoken';

    public function response($data, int $statusCode) {
        $response = ["data" => $data, "statusCode" => $statusCode];
        return $response;
    }
}
