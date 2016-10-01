<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('visible_name');
            $table->string('alias_name')->nullable(true);
            $table->integer('alias_value')->nullable(true);
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('catalog_filter_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('catalog_product_properties');
    }
}
