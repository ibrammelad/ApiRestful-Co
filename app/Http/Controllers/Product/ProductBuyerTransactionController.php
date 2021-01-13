<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Facade\FlareClient\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductBuyerTransactionController extends ApiController
{

    public function store(Request $request , Product $product , User $buyer)
    {
        $rules = [
            'quantity' => 'required|integer|min:1'
        ];
        $this->validate($request , $rules);
        if ($buyer->id == $product->seller_id)
        {
            return $this->errorResponse('the buyer must be different from the seller' , 409);
        }
        if (!$buyer->isVerified())
        {
            return $this->errorResponse('the buyer must be verified user ' , 409);
        }
        if (!$product->seller->isVerified())
        {
            return $this->errorResponse('the seller must be verified user ' , 409);
        }
        if (!$product->isAvailable())
        {
            return $this->errorResponse('The product is not available  ' , 409);
        }
        if ($product->quantity < $request->quantity  )
        {
            return $this->errorResponse('The product do not have enough units for this transactions or out of stock  ' , 409);
        }

        return  DB::transaction(function () use ($request , $product , $buyer){
            $product->quantity = $product->quantity - $request->quantity;
                if (($product->quantity == 0) && $product->isAvailable())
                {
                    $product->status = Product::UNAVAILABLE_PRODUCT;
                    $product->save();
                }
            $product->save();

            $transaction = Transaction::create([
                'quantity' => $request->quantity,
                'buyer_id' => $buyer->id,
                'product_id' => $product->id,
            ]);
            return $this->showOne($transaction , 201);
        });



    }
}
