<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\CatalogProduct;
use App\Models\Entities\CatalogCategory;

class CatalogProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new CatalogProduct();
        $model->visible_name = 'MVP-112';
        $model->alias_name = 'mvp-112';
        $model->description = 'Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore';
        $model->image_url = '57ceac8bb6fb8.jpeg';
        $model->author_id = 1;
        $model->save();
        $model->categories()->sync([ 1, 2 ]);

        $model = new CatalogProduct();
        $model->visible_name = 'Dell Inspiron 3552 (I35C25NIW-46) Black';
        $model->alias_name = 'I35C25NIW-46';
        $model->description = 'Экран 15.6" (1366x768) HD, глянцевый / Intel Celeron N3050 (1.6 - 2.16 ГГц) / RAM 2 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / Wi-Fi / Bluetooth / веб-камера / Windows 10 Home / 2.14 кг / черный';
        $model->image_url = '57cebb188a15a.jpeg';
        $model->author_id = 1;
        $model->save();
        $category = CatalogCategory::find(3);
        $model->categories()->attach($category);

        $model = new CatalogProduct();
        $model->visible_name = 'Asus EeeBook E502SA (E502SA-XO019T) White';
        $model->alias_name = 'E502SA-XO019T';
        $model->description = 'Экран 15.6" (1366x768) HD, матовый / Intel Celeron N3150 (1.16 ГГц) / RAM 4 ГБ / HDD 500 ГБ / Intel HD Graphics / без ОД / LAN / Wi-Fi / Bluetooth / веб-камера / Windows 10 / 1.86 кг / белый';
        $model->image_url = '57cebf5babc73.jpeg';
        $model->author_id = 1;
        $model->save();
        $category = CatalogCategory::find(3);
        $model->categories()->attach($category);

        $model = new CatalogProduct();
        $model->visible_name = 'MVP-200';
        $model->alias_name = 'mvp-200';
        $model->description = 'Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore';
        $model->image_url = '57ceaceac9c00.jpeg';
        $model->author_id = 1;
        $model->save();
        $category = CatalogCategory::find(1);
        $model->categories()->attach($category);
    }
}
