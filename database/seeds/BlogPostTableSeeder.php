<?php

use App\Models\Entities\BlogPost;
use App\Models\Entities\BlogCategory;
use Illuminate\Database\Seeder;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $model = new BlogPost();
        $model->title = 'About me';
        $model->alias_name = 'about-me';
        $model->preview_content = '<h1>Lorem ipsum san delore</h1>';
        $model->content = '<p>Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore</p>';
        $model->author_id = 1;
        $model->save();
        $category = BlogCategory::find(1);
        $model->categories()->attach($category);

        $model = new BlogPost();
        $model->title = 'Hello world';
        $model->preview_content = '<h1>Delore lorem ipsum san</h1>';
        $model->content = '<p>Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore</p>';
        $model->author_id = 1;
        $model->save();
        $model->categories()->sync([ 2, 3 ]);

        $model = new BlogPost();
        $model->title = 'Some test';
        $model->content = 'Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore';
        $model->author_id = 1;
        $model->save();
        $model->categories()->sync([ 2, 4 ]);

        $model = new BlogPost();
        $model->title = 'And here some test';
        $model->content = 'Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore Lorem ipsum san delore';
        $model->author_id = 1;
        $model->save();
        $category = BlogCategory::find(3);
        $model->categories()->attach($category);
    }
}
