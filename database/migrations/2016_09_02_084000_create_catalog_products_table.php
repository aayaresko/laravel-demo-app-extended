<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCatalogProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('visible_name')->nullable(false);
            $table->string('alias_name')->nullable(false);
            $table->string('image_url')->nullable(true);
            $table->text('description')->nullable(true);
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('catalog_products');
    }
}
