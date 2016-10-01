<?php

use Illuminate\Database\Seeder;
use App\Models\Entities\CatalogFilterCategory;

class CatalogProductPropertyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $property = CatalogFilterCategory::where('alias_name', 'color')->first();
        $model = $property->properties()->create([
            'visible_name' => 'Green',
            'alias_name' => 'green'
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => 'Red',
            'alias_name' => 'red'
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => 'Blue',
            'alias_name' => 'blue'
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => 'Yellow',
            'alias_name' => 'yellow'
        ]);
        $model->save();

        $property = CatalogFilterCategory::where('alias_name', 'size')->first();
        $model = $property->properties()->create([
            'visible_name' => 'Size xl',
            'alias_name' => 'xl'
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => 'Size xxl',
            'alias_name' => 'xxl'
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => 'Size m',
            'alias_name' => 'm'
        ]);
        $model->save();

        $property = CatalogFilterCategory::where('alias_name', 'weight')->first();
        $model = $property->properties()->create([
            'visible_name' => '2 Kg',
            'alias_value' => 2
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '3 Kg',
            'alias_value' => 3
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '4 Kg',
            'alias_value' => 4
        ]);
        $model->save();

        $property = CatalogFilterCategory::where('alias_name', 'processor')->first();
        $model = $property->properties()->create([
            'visible_name' => 'Intel',
            'alias_name' => 'intel'
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => 'AMD',
            'alias_name' => 'amd'
        ]);
        $model->save();

        $property = CatalogFilterCategory::where('alias_name', 'screen_size')->first();
        $model = $property->properties()->create([
            'visible_name' => '9"',
            'alias_value' => 9
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '12.5"',
            'alias_value' => 12
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '13"',
            'alias_value' => 13
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '14"',
            'alias_value' => 14
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '15.6"',
            'alias_value' => 15
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '16"',
            'alias_value' => 16
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '17"',
            'alias_value' => 17
        ]);
        $model->save();

        $property = CatalogFilterCategory::where('alias_name', 'ram_size')->first();
        $model = $property->properties()->create([
            'visible_name' => '1 Gb',
            'alias_value' => 1024
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '2 Gb',
            'alias_value' => 2048
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '4 Gb',
            'alias_value' => 4096
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '6 Gb',
            'alias_value' => 6144
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '8 Gb',
            'alias_value' => 8192
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '10 Gb',
            'alias_value' => 10240
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '12 Gb',
            'alias_value' => 12288
        ]);
        $model->save();
        $model = $property->properties()->create([
            'visible_name' => '14 Gb',
            'alias_value' => 14336
        ]);
        $model->save();
    }
}
