<?php

namespace App\Helpers;
use App\Connection;

class Fipe
{
    public static function get($placa)
    {
        $url = 'https://cluster-01.apigratis.com/api/v1/vehicles/fipe';
        $headers = array(
            'Content-Type: application/json',
            'SecretKey: 193b1f11-49ae-4a43-80bc-8b3349651632',
            'PublicToken: a2743b52063cd87a65d1633f5c74f5',
            'DeviceToken: 8adf225d-2602-4c84-904f-b2c3db6e07f5',
            'Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL3BsYXRhZm9ybWEuYXBpYnJhc2lsLmNvbS5ici9zb2NpYWwvZ2l0aHViL2NhbGxiYWNrIiwiaWF0IjoxNjgwNzkyNjE4LCJleHAiOjE3MTIzMjg2MTgsIm5iZiI6MTY4MDc5MjYxOCwianRpIjoiR01tNVl2NXJFb1hjdEpoSyIsInN1YiI6IjIwNTgiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.6o7gYMuH59ncG5stklrhG8G5oj-1jn-bgJBIZw6GjJU'
        );
        $data = array(
            'placa' => $placa
        );
        $data = json_encode($data);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}