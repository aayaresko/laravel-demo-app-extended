<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogFiltersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_filters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->tinyInteger('type_id')->unsigned();
            $table->tinyInteger('priority')->unsigned()->default(0);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('catalog_filter_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('catalog_category_id')->unsigned();
            $table->foreign('catalog_category_id')->references('id')->on('catalog_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('left_property_id')->unsigned()->nullable(true)->default(null);
            $table->foreign('left_property_id')->references('id')->on('catalog_product_properties')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('right_property_id')->unsigned()->nullable(true)->default(null);
            $table->foreign('right_property_id')->references('id')->on('catalog_product_properties')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('is_disabled')->unsigned()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_filters');
    }
}
