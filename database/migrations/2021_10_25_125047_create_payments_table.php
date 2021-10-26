<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('referenceNumber')->nullable();
            $table->string('merchantRefNumber')->nullable();
            $table->float('orderAmount')->nullable();
            $table->float('paymentAmount')->nullable();
            $table->float('fawryFees')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->string('orderStatus')->nullable();
            $table->string('paymentTime')->nullable();
            $table->string('Mobile')->nullable();
            $table->string('Mail')->nullable();
            $table->string('customerProfileId')->nullable();
            $table->string('signature')->nullable();
            $table->integer('statusCode');
            $table->string('statusDescription');
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
        Schema::dropIfExists('payments');
    }
}
