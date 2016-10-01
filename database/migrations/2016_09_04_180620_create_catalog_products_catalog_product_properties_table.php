<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductsCatalogProductPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_products_catalog_product_properties', function(Blueprint $table) {
            $table->integer('product_id')->unsigned();
            $table
                ->foreign('product_id')
                ->references('id')->on('catalog_products')
                ->onDelete('cascade')->onUpdate('cascade');
            $table->integer('property_id')->unsigned();
            $table
                ->foreign('property_id')
                ->references('id')->on('catalog_product_properties')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalog_products_catalog_product_properties');
    }
}
