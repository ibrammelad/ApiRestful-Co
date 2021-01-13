<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController
{

    public function index()
    {
        $Product = Product::all();
        return $this->showAll($Product);
    }

    public function show(Product $Product)
    {
        return $this->showOne($Product);
    }
}
