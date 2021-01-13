<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\ApiController;
use App\Models\Buyer;
use Illuminate\Http\Request;

class BuyerController extends ApiController
{

    public function index()
    {
        $buyers = Buyer::has('transactions')->get();
        if (is_null($buyers))
        {
            return $this->errorResponse('Not Found Record', 404);

        }
        return $this->showAll($buyers);
    }


    public function show($id)
    {
        $buyer = Buyer::has('transactions')->get()->find($id);
        if (is_null($buyer))
        {
            return $this->errorResponse('Not Found Record', 404);

        }
        return $this->showOne($buyer);
    }

}
