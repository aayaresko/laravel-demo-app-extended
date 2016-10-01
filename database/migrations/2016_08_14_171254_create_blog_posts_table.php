<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable(false);
            $table->string('preview_content')->nullable(true);
            $table->string('alias_name')->nullable(false);
            $table->text('content')->nullable(false);
            $table->string('preview_image_url')->nullable(true);
            $table->integer('author_id')->unsigned();
            $table->foreign('author_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('is_published')->unsigned()->default(1);
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
        Schema::dropIfExists('blog_posts');
    }
}
