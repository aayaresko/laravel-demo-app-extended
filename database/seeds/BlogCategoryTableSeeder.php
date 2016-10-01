<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\BlogCategory;

class BlogCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new BlogCategory();
        $model->visible_name = 'Site';
        $model->description = 'Site pages';
        $model->save();

        $model = new BlogCategory();
        $model->visible_name = 'Life';
        $model->description = 'Articles about life';
        $model->save();

        $model = new BlogCategory();
        $model->visible_name = 'Tech';
        $model->description = 'Technical Articles';
        $model->save();

        $model = new BlogCategory();
        $model->visible_name = 'Sports';
        $model->description = 'Sports Articles';
        $model->save();
    }
}
