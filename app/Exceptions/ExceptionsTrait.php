<?php

namespace App\Exceptions;
 use Illuminate\Database\Eloquent\ModelNotFoundException;
 use Illuminate\Validation\ValidationException;
 use SebastianBergmann\Timer\TimeSinceStartOfRequestNotAvailableException;
 use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

 trait  ExceptionsTrait
 {
     public function apiException($exception , $request)
     {
         if ($this->isModel($exception)) {
             return $this->ModelResponse($exception);
         }

         if ($this->isHTTP($exception)) {
             return  $this->HTTPResponse($exception);

         }
         return Parent::render($request , $exception);

     }

     public function isModel($exception)
     {
         return $exception instanceof ModelNotFoundException;
      }

     public function isHTTP($exception)
     {
         return $exception instanceof NotFoundHttpException;
      }

     public function ModelResponse($ex)
     {
         return response()->json(['errors' => 'Model not found'], 404);
      }

     public function HTTPResponse($ex)
     {
        return response()->json(['errors' => 'Route not correct'], 404);
     }



 }
