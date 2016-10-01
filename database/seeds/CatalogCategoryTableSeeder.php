<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\CatalogCategory;

class CatalogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new CatalogCategory();
        $model->visible_name = 'Bicycles';
        $model->alias_name = 'bicycles';
        $model->description = 'All bicycles here';
        $model->save();

        $model = new CatalogCategory();
        $model->visible_name = 'Sport';
        $model->alias_name = 'sport';
        $model->description = 'Sport appliances';
        $model->save();

        $model = new CatalogCategory();
        $model->visible_name = 'Notebooks';
        $model->alias_name = 'notebooks';
        $model->description = 'All notebooks here';
        $model->save();
    }
}
