<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryProductController extends ApiController
{

    public function index(category $category)
    {
        $products = $category->Products;
        return $this->showAll($products);

    }

}
