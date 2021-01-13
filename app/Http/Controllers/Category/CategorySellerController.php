<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Models\category;

class CategorySellerController extends ApiController
{

    public function index(category $category)
    {
        $seller = $category->Products()->with('seller')->get()->pluck('seller')->unique('id')->values();
        return $this->showAll($seller);

    }

}
