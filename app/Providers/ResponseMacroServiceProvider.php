<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * 注册响应宏
     *
     * @return void
     */
    public function boot()
    {
        Response::macro('api', function ($msg = '', $code = 200, $data = '') {
            $resData = [
                'code' => $code,
                'msg' => $msg,
                'time' => time(),
                'data' => $data
            ];
            return response()->json($resData);
        });
    }
}
