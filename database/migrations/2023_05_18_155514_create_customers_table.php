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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->required();
            $table->string('contact_name')->nullable();
            $table->string('ruc')->nullable();
            $table->string('ubication')->nullable();
            $table->string('address')->required();
            $table->string('phone')->nullable();
            $table->unsignedInteger('customer_type_id')->required();
            $table->foreign('customer_type_id')->references('id')->on('customer_types');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
};
