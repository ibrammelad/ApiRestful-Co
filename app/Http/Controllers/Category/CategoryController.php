<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends ApiController
{
    public function index()
    {
        $category = category::all();
        return $this->showAll($category);
    }

    public function show(category $category)
    {
        return $this->showOne($category);
    }

}
