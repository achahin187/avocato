<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserCompanyDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_company_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('commercial_registration_number')->nullable();
            $table->string('fax')->nullable();
            $table->string('website')->nullable();
            $table->string('legal_representative_name');
            $table->string('legal_representative_mobile')->nullable();
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
        Schema::dropIfExists('user__company__details');
    }
}
