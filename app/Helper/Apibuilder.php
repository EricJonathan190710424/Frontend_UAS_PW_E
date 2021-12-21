<?php

namespace App\Helper;

class Apibuilder
{

    public static function apiRespond($code, $data, $message = null)
    {
        $response['status'] = $code;

        if ($code == 200) {
            $response['message'] = "Success";
        } elseif ($code == 201) {
            $response['message'] = "Success! Please Verify your email!";
        } elseif ($code == 404) {
            $response['message'] = "Not Found";
        } elseif ($code == 400) {
            $response['message'] = "Bad Request";
        } elseif ($code == 401) {
            $response['message'] = "Unauthorized";
        } elseif ($code == 405) {
            $response['message'] = "Method Not Allowed";
        } else {
            $response['message'] = "Internal Server Error";
        }

        if ($message) {
            $response['message'] = $message;
        }

        $response['data'] = $data;
        if ($data instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            $response['data'] = [
                'data'      => $data->getCollection(),
                'paging'    => [
                    'first'         => $data->url(1),
                    'last'          => $data->url($data->lastPage()),
                    'prev'          => $data->previousPageUrl(),
                    'next'          => $data->nextPageUrl(),
                    'current_page'  => $data->currentPage(),
                    "from"          => 1,
                    "last_page"     => $data->lastPage(),
                    "per_page"      => $data->perPage(),
                ]
            ];
        }

        return response()->json($response, $code);
    }
}
