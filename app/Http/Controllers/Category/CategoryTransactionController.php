<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryTransactionController extends ApiController
{

    public function index(category $category)
    {
        $transactions = $category->Products()->whereHas('transactions')
        ->with('transactions')->get()->pluck('transactions')->collapse();
        return $this->showAll($transactions);
    }
}
