<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AccountTableSeeder::class);
        $this->call(ContactMessageTableSeeder::class);
        $this->call(BlogCategoryTableSeeder::class);
        $this->call(BlogPostTableSeeder::class);
        $this->call(CatalogCategoryTableSeeder::class);
        $this->call(CatalogProductTableSeeder::class);
        $this->call(CatalogFilterCategoryTableSeeder::class);
        $this->call(CatalogProductPropertyTableSeeder::class);
        $this->call(CatalogFilterTableSeeder::class);
        $this->call(CatalogProductImageTableSeeder::class);
    }
}
