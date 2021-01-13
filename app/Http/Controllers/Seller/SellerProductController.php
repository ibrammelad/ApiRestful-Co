<?php

namespace App\Http\Controllers\Seller;

use App\Exceptions\ProductNotBelongsToUser;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\SellerProductRequest;
use App\Models\Product;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerProductController extends ApiController
{

    public function index(Seller $seller)
    {
        $products = $seller->products;
        return $this->showAll($products);
    }

    public function store(SellerProductRequest $request , Seller $seller)
    {
        $data = $request->except('image');
        $data['status'] = Product::UNAVAILABLE_PRODUCT;
        $data['image'] ='1.jpg' ;
        $data['seller_id'] =$seller->id ;
       $product = Product::create($data);
        return $this->showOne($product);
    }

    public function update(Request $request , Seller $seller, Product $product )
    {
        $rules = [
            'quantity' => 'required|min:1',
            'status'  => 'in:'.Product::UNAVAILABLE_PRODUCT .', '.Product::AVAILABLE_PRODUCT,
            'image' => 'image'
       ];
        $this->checkSeller($product , $seller);
        $product->fill($request->only(['name' , 'description' ,'quantity']));
        if ($request->has('status'))
        {
            $product->status = $request->status ;
            if ($product->isAvailable()&& $product->categories->count() == 0)
            {
                return $this->errorResponse('an active product must have at least one category',409);
            }
        }
        if ($product->isClean())
        {
            return $this->errorResponse('you need different value to update',422);
        }
        $product->save();
        return $this->showOne($product);
    }

    public function destroy(Seller $seller , Product $product)
    {
        $this->checkSeller($product , $seller);
        $product->delete();
        return $this->successResponse($product , 200);
    }
    public function checkSeller(Product $product , Seller $seller)
    {
        if($seller->id != $product->seller_id)
        {
            Throw new ProductNotBelongsToUser ;
        }
    }

}
