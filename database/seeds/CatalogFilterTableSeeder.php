<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\CatalogFilter;
use App\Models\Entities\CatalogCategory;

class CatalogFilterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = CatalogCategory::where('alias_name', 'notebooks')->first();
        $model = $category->filters()->create([
            'title' => '9" - 12.5"',
            'type_id' => CatalogFilter::FILTER_IN_RANGE,
            'category_id' => 2,
            'left_property_id' => 13,
            'right_property_id' => 14,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => '13"',
            'type_id' => CatalogFilter::FILTER_IS_EQUAL,
            'category_id' => 2,
            'left_property_id' => 15,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => '14" - 15.6"',
            'type_id' => CatalogFilter::FILTER_IN_RANGE,
            'category_id' => 2,
            'left_property_id' => 16,
            'right_property_id' => 17,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => '16" - 17"',
            'type_id' => CatalogFilter::FILTER_IN_RANGE,
            'category_id' => 2,
            'left_property_id' => 18,
            'right_property_id' => 19,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => 'lower than 4 Gb',
            'type_id' => CatalogFilter::FILTER_IN_RANGE,
            'category_id' => 3,
            'right_property_id' => 22,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => '4 - 6 Gb',
            'type_id' => CatalogFilter::FILTER_IN_RANGE,
            'category_id' => 3,
            'left_property_id' => 22,
            'right_property_id' => 23,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => '8 - 10 Gb',
            'type_id' => CatalogFilter::FILTER_IN_RANGE,
            'category_id' => 3,
            'left_property_id' => 24,
            'right_property_id' => 25,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => '12 Gb and bigger',
            'type_id' => CatalogFilter::FILTER_IN_RANGE,
            'category_id' => 3,
            'left_property_id' => 26,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => 'INTEL processors',
            'type_id' => CatalogFilter::FILTER_IS_EQUAL,
            'category_id' => 1,
            'left_property_id' => 11,
        ]);
        $model->save();
        $model = $category->filters()->create([
            'title' => 'AMD processors',
            'type_id' => CatalogFilter::FILTER_IS_EQUAL,
            'category_id' => 1,
            'left_property_id' => 12,
        ]);
        $model->save();
    }
}
