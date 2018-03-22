<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
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
            $table->integer('parent_id')->nullable();
            $table->string('name')->unique();
            $table->string('password');
            $table->string('full_name');
            $table->string('email');
            $table->string('image')->nullable();
            $table->string('phone');
            $table->string('mobile');
            $table->string('address')->nullable();
            $table->string('code')->nullable()->unique();
            $table->date('birthdate')->nullable();
            $table->string('creditcard_number')->nullable();
            $table->integer('creditcard_cvv')->nullable();
            $table->integer('creditcard_month')->nullable();
            $table->string('creditcard_year')->nullable();
            $table->tinyInteger('is_active');
            $table->softDeletes();
            $table->string('verificaition_code')->nullable();
            $table->tinyInteger('is_verification_code_expired')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->string('api_token')->nullable();
            $table->string('device_token')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
      });

        DB::table('users')->insert(
            array(
                'id'=>1,
                'name'=>'super',
                'password'=>'super',
                'full_name'=>'super_super',
                'email'=>'super@super.com',
                'phone'=>'033333330',
                'mobile'=>'01110900713',
                'is_active'=>1,
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
