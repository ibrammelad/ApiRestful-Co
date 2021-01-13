<?php

namespace App\Exceptions;

use Exception;

class ProductNotBelongsToUser extends Exception
{
    public function render()
    {
        return ["error" => 'this seller is not actual seller the product','code'=> 422];
    }
}
