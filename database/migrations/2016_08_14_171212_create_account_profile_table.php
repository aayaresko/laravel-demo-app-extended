<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateAccountProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_profile', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->dateTime('birth_date')->nullable(true);
            $table->string('avatar_url')->nullable(true);
            $table->integer('account_id')->unsigned()->nullable(false);
            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('account_profile');
    }
}
