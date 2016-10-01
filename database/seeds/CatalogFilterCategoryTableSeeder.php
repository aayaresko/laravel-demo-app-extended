<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\CatalogFilterCategory;

class CatalogFilterCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new CatalogFilterCategory();
        $model->visible_name = 'Processor manufacturer';
        $model->alias_name = 'processor';
        $model->save();

        $model = new CatalogFilterCategory();
        $model->visible_name = 'Screen size';
        $model->alias_name = 'screen_size';
        $model->save();

        $model = new CatalogFilterCategory();
        $model->visible_name = 'RAM memory size';
        $model->alias_name = 'ram_size';
        $model->save();

        $model = new CatalogFilterCategory();
        $model->visible_name = 'Color';
        $model->alias_name = 'color';
        $model->save();

        $model = new CatalogFilterCategory();
        $model->visible_name = 'Size';
        $model->alias_name = 'size';
        $model->save();

        $model = new CatalogFilterCategory();
        $model->visible_name = 'Weight';
        $model->alias_name = 'weight';
        $model->save();
    }
}
