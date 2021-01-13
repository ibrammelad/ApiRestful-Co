<?php

namespace App\Http\Controllers\Transaction;

use App\Http\Controllers\ApiController;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends ApiController
{

    public function index()
    {
        $transaction = Transaction::all();
        return $this->showAll($transaction);
    }

    public function show(Transaction $transaction)
    {
        return $this->showOne($transaction);
    }
}
