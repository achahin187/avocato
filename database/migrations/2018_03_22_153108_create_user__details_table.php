<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user__details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('country_id')->nullable();
            $table->integer('nationality_id')->nullable();
            $table->integer('gender_id')->nullable();
            $table->string('job_title')->nullable();
            $table->string('national_id')->nullable();
            $table->string('work_sector')->nullable();
            $table->string('work_sector_type')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->date('join_date')->nullable();
            $table->date('resign_date')->nullable();
            $table->boolean('is_resigned')->default(0);
            $table->string('authorization_copy')->nullable();
            $table->string('syndicate_copy')->nullable();
            $table->string('syndicate_level')->nullable();
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
        Schema::dropIfExists('user_details');
    }
}
