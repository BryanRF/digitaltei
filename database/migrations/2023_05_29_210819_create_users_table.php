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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('status')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->unsignedInteger('user_types_id')->notNull();
            $table->unsignedInteger('employees_id')->nullable();
            $table->unsignedInteger('customers_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('user_types_id')->references('id')->on('user_types');
            $table->foreign('employees_id')->references('id')->on('employees');
            $table->foreign('customers_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user');
    }
};
