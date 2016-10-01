<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_product_images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->nullable(false);
            $table->string('alt')->nullable(true);
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('catalog_products')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('catalog_product_images');
    }
}
