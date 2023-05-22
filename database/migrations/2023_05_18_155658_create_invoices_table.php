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
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('id');
                $table->string('number');
                $table->date('date_start');
                $table->date('date_end')->nulleable();
                $table->decimal('total_amount', 8, 2);
                $table->unsignedInteger('customer_id');
                $table->unsignedInteger('service_id');
                $table->foreign('customer_id')->references('id')->on('customers');
                $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('invoices');
    }
};
