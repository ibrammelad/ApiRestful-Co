<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;

class TransactionCategoryController extends ApiController
{

    public function index(Transaction $transaction)
    {
        if (is_null($transaction))
        {
            return $this->errorResponse('Not Found Record', 404);

        }
       $categories =  $transaction->product->categories;
       return $this->showAll($categories);

    }
}
