<?php

namespace App\Triats;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

trait Apiresponse
{
    protected function successResponse($data , $code)
    {
        return response()->json(['data' => $data] , $code);
    }

    protected function errorResponse($message , $code)
    {
        return response()->json(['message' => $message , "code" => $code] , $code);
    }

    protected function showAll(Collection $collection , $code = 200)
    {
        return response()->json(['data' => $collection] , $code);
    }
    protected function showOne(Model $model , $code = 200)
    {
        return response()->json(['data' => $model] , $code);
    }
}
