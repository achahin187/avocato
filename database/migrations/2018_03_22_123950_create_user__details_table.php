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
        Schema::create('user_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('country_id');
            $table->integer('nationality_id');
            $table->integer('gender_id');
            $table->string('job_title');
            $table->string('national_id');
            $table->string('work_sector')->nullable();
            $table->string('work_sector_type')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->date('join_date')->nullable();
            $table->date('resign_date')->nullable();
            $table->tinyInteger('is_resigned')->default(0);
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
        Schema::dropIfExists('user__details');
    }
}
