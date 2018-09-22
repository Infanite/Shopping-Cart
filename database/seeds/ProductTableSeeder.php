<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new \App\Product([
            'imagePath'=> 'https://images-na.ssl-images-amazon.com/images/I/512duVU966L._SX322_BO1,204,203,200_.jpg',
            'title' => 'Harry Potter',
            'description' => 'Super cool - at least as a child.',
            'price' => 550
        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath'=> 'https://images-na.ssl-images-amazon.com/images/I/512duVU966L._SX322_BO1,204,203,200_.jpg',
            'title' => 'Harry Potter',
            'description' => 'Super cool - at least as a child.',
            'price' => 540
        ]);
        $product->save();

        $product = new \App\Product([
            'imagePath'=> 'https://images-na.ssl-images-amazon.com/images/I/512duVU966L._SX322_BO1,204,203,200_.jpg',
            'title' => 'Harry Potter',
            'description' => 'Super cool - at least as a child.',
            'price' => 540
        ]);
        $product->save();

    }
}
