<?php

use App\Http\Controllers\Buyer\BuyerController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerSellerController;
use App\Http\Controllers\Buyer\BuyerTransactionController;
use App\Http\Controllers\Category\CategoryController;
use App\Http\Controllers\Category\CategoryProductController;
use App\Http\Controllers\Product\ProductBuyerController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Product\ProductTransactionController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\Seller\SellerTransactionController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Http\Controllers\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 * buyers
*/
Route::apiResource('buyers' , BuyerController::class)->only('index', 'show');
Route::apiResource('buyers/{buyer}/transactions' , BuyerTransactionController::class)->only('index');
Route::apiResource('buyers/{buyer}/products' , BuyerProductController::class)->only('index');
Route::apiResource('buyers/{buyer}/sellers' , BuyerSellerController::class)->only('index');
Route::apiResource('buyers/{buyer}/categories' , \App\Http\Controllers\Buyer\BuyerCategoryController::class)->only('index');

/*
* sellers
*/
Route::apiResource('sellers' , SellerController::class)->only('index', 'show');
Route::apiResource('sellers/{seller}/transactions' , SellerTransactionController::class)->only('index');
Route::apiResource('sellers/{seller}/categories' , \App\Http\Controllers\Seller\SellerCategoryController::class)->only('index');
Route::apiResource('sellers/{seller}/buyers' , \App\Http\Controllers\Seller\SellerBuyerController::class)->only('index');
Route::apiResource('sellers/{seller}/products' , \App\Http\Controllers\Seller\SellerProductController::class);


/*
* categories
*/
Route::apiResource('categories' , CategoryController::class);
Route::apiResource('categories/{category}/products' , CategoryProductController::class)->only('index');
Route::apiResource('categories/{category}/sellers' , \App\Http\Controllers\Category\CategorySellerController::class)->only('index');
Route::apiResource('categories/{category}/transactions' , \App\Http\Controllers\Category\CategoryTransactionController::class)->only('index');
Route::apiResource('categories/{category}/buyers' , \App\Http\Controllers\Category\CategoryBuyerController::class)->only('index');

/*
* transactions
*/
Route::apiResource('transactions' , TransactionController::class)->only('index', 'show');
Route::apiResource('transactions/{transaction}/categories' , \App\Http\Controllers\Transaction\TransactionCategoryController::class)->only('index');
Route::apiResource('transactions/{transaction}/sellers' , \App\Http\Controllers\Transaction\TransactionSellerController::class)->only('index');


/*
* products
*/
Route::apiResource('products' , ProductController::class)->only('index', 'show');
Route::apiResource('products/{product}/transactions' , ProductTransactionController::class)->only('index');
Route::apiResource('products/{product}/buyers' , ProductBuyerController::class)->only('index');
Route::apiResource('products/{product}/categories' , \App\Http\Controllers\Product\ProductCategoryController::class)->only('index' , 'update' , 'destroy');
Route::post('products/{product}/categories' ,[\App\Http\Controllers\Product\ProductCategoryController::class, 'makeProductAvailable'] );
Route::apiResource('products/{product}/buyers/{buyer}/transactions' , \App\Http\Controllers\Product\ProductBuyerTransactionController::class)->only('store');


/*
* users
*/
Route::apiResource('users' , UserController::class);
