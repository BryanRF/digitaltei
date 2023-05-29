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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            // $table->string('table');
            // $table->unsignedBigInteger('table_id');
            // $table->string('action');
            // $table->string('description');
            // $table->text('old_values')->nullable();
            // $table->text('new_values')->nullable();
            // $table->text('extra_one_values')->nullable();
            // $table->text('extra_two_values')->nullable();
            // $table->unsignedBigInteger('user_id')->nullable();
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('audit_logs');
    }
};
