<?php

use App\Models\Entities\CatalogProduct;
use Illuminate\Database\Seeder;

class CatalogProductImageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = CatalogProduct::findOrFail(2);
        $model = $product->images()->create([
            'url' => '57cebb2172f23.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebb2185bad.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebb21995e5.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebb21afab1.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebb21bb9e4.jpeg'
        ]);
        $model->save();

        $product = CatalogProduct::findOrFail(3);
        $model = $product->images()->create([
            'url' => '57cebf6566b22.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf658712d.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf65a4a24.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf65b9544.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf65d2b45.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf65f0ad9.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf6613da4.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf662977e.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf664159d.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf66556b5.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf6667ad0.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf666f9dd.jpeg'
        ]);
        $model->save();
        $model = $product->images()->create([
            'url' => '57cebf66791d1.jpeg'
        ]);
        $model->save();
    }
}
