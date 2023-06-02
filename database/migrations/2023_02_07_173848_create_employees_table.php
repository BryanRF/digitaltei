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
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->notNull();
            $table->string('lastname')->notNull();
            $table->string('document')->notNull()->unique();
            $table->string('email')->notNull()->unique();
            $table->string('address')->nullable();
            $table->string('slug')->nullable();
            $table->date('birthday_date')->notNull();
            $table->enum('gender', ['Femenino', 'Masculino'])->notNull();
            $table->string('phone')->notNull()->unique();
            $table->string('avatar')->nullable();
            $table->string('file')->nullable();
            $table->boolean('isUser')->default(0)->nullable();
            $table->unsignedInteger('job_id')->notNull();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('job_id')->references('id')->on('jobs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
