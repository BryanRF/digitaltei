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
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('employee_id')->required();
            $table->unsignedInteger('job_id')->required();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('file')->nullable();
            $table->string('description');
            $table->decimal('salary', 8, 2);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('job_id')->references('id')->on('jobs');
            $table->foreign('employee_id')->references('id')->on('employees');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contracts');
    }
};
