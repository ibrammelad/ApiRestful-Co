<?php

namespace Database\Seeders;

use App\Models\category;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        DB::table('category_product')->truncate();

         User::factory(10)->create();
         category::factory(15)->create();
         Product::factory(50)->create()->each(function($product) {
             $randomFields= category::all()->random( rand(0, 4) )->pluck('id');
             $product->categories()->attach($randomFields);
         });
         Transaction::factory(50)->create();
//




    }
}
