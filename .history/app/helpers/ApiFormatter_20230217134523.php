<?php 

namespace App\Helpers;

class ApiFormatter{
    protected static $response=[
        'status'=>[
            'code' => null,
            'message' => null,
        ],
        'data'=> null
    ];

    public static function createApi($code = null, $message=null, $data=null){
        self::$response['status']['code'] = $code;
        self::$response['status']['message'] = $message;
        self::$response['data']= $data;

        return response()->json(self::$response, self::$response['status']['code']);
    }
}

;?>
