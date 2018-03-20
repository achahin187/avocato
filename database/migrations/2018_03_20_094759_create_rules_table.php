<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('name_ar');
        });
        DB::table('rules')->insert(
            array(
                array( 'id' => 1,'name' => 'super admin','name_ar' => 'سوبر ادمن'),
                array( 'id' => 2,'name' => 'admin','name_ar' => 'ادمن'),
                array( 'id' => 3,'name' => 'data entry','name_ar' => 'مدخل بيانات'),
                array( 'id' => 4,'name' => 'call center','name_ar' => 'خدمة العملاء'),
                array( 'id' => 5,'name' => 'lawyer','name_ar' => 'محامي'),
                array( 'id' => 6,'name' => 'client','name_ar' => 'عميل'),
                array( 'id' => 7,'name' => 'app_user','name_ar' => 'مستخدم تطبيق'),
                array( 'id' => 8,'name' => 'individuals','name_ar' => 'افراد'),
                array( 'id' => 9,'name' => 'company','name_ar' => 'شركات'),
                array( 'id' => 10,'name' => 'company - individuals','name_ar' => 'افراد - شركات'),
                array( 'id' => 11,'name' => 'secure bridge lawyer','name_ar' => 'محامي جسر الامان'),
                array( 'id' => 12,'name' => 'free lawyer','name_ar' => 'محامي حر'),
                array( 'id' => 13,'name' => 'backend user','name_ar' => 'مستخدم لوحة التحكم'),
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
        Schema::dropIfExists('rules');
    }
}
