<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductCategoryController extends ApiController
{
    public function index(Product $product)
    {
        $categories = $product->categories;
        return $this->showAll($categories);
    }
    public function makeProductAvailable(Product $product , category $category)
    {
        if (!$product->categories || $product->quantity == 0)
        {
            return $this->errorResponse('this product not have category or out of stock' , 404);
        }
        $product->status = Product::AVAILABLE_PRODUCT;
        $product->save();
        return  $this->showOne($product);
    }
    public function update(Product $product , category $category)
    {
        // sync , attach , syncWithoutDetaching
        $product->categories()->syncWithoutDetaching([$category->id]);
        return $this->showAll($product->categories);

    }

    public function destroy(Product $product , category $category)
    {
        if (!$product->categories()->find($category->id))
        {
            return $this->errorResponse('this category not category of this product' , 404);
        }
            $product->categories()->detach([$category->id]);
            return $this->showAll($product->categories);

    }
}
