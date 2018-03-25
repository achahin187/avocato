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
            $table->string('password')->nullable();
            $table->string('full_name');
            $table->string('email')->nullable();
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('mobile');
            $table->string('address')->nullable();
            $table->string('code')->nullable()->unique();
            $table->date('birthdate')->nullable();
            $table->string('creditcard_number')->nullable();
            $table->integer('creditcard_cvv')->nullable();
            $table->integer('creditcard_month')->nullable();
            $table->string('creditcard_year')->nullable();
            $table->boolean('is_active')->default(1);
            $table->softDeletes();
            $table->string('verificaition_code')->nullable();
            $table->boolean('is_verification_code_expired')->nullable();
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
                'name'=>'admin',
                'password'=>'$2y$10$1gHFYPB4PMUG.rjq3Cs.X.XLYv4uBir20HbDRB2Y7TTwsCm4/DjvG',
                'full_name'=>'admin',
                'email'=>'admin@securebridge.com',
                'image'=>'male.jpg',
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
