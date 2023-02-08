<?php

namespace Database\Seeders;

use DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */


    public function run()
    {
        $val = 0;
        $q = 0;
        //
        for ($i = 0; $i < 100; $i ++) {
            $val += 1000;
            $q += 2;
            DB::table("products")->insert(
                [
                    "p_name" => Str::random(20),
                    "p_price" => $val,
                    "p_quantity" => $q,
                    "cat_id" => 10
                ]
                );
        }
        
    }
}
