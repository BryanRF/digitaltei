<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('sub_categories', function (Blueprint $table) {
        $table->increments('id');
        $table->string('name', 100)->required();
        $table->unsignedInteger('category_id')->required();
        $table->timestamps();
        $table->foreign('category_id')->references('id')->on('categories');
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_categories');
    }
};
