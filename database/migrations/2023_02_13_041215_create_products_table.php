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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->required();
            $table->text('description')->nullable();
            $table->double('price')->required();
            $table->string('presentation')->nullable();
            $table->string('code')->unique();
            $table->boolean('status')->default(true);
            $table->string('slug')->nullable();
            $table->string('image')->default('images/default_product.png');
            $table->unsignedInteger('brand_id')->required();
            $table->unsignedInteger('subcategory_id')->required();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->foreign('subcategory_id')->references('id')->on('sub_categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
