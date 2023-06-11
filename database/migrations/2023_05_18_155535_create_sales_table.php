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
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id')->required();
            $table->unsignedInteger('employee_id')->nullable();
            $table->unsignedInteger('payment_method_id')->required();
            $table->date('date');
            $table->string('code')->unique();
            $table->decimal('total_amount', 8, 2);
            $table->string('payment_status');
            $table->string('status');
            $table->foreign('payment_method_id')->references('id')->on('payment_methods');
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('sales');
    }
};
