<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_rules', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('rule_id');
            $table->softDeletes();
        });

                DB::table('users_rules')->insert(
            array(
                array( 'id' => 1,'user_id' => 1,'rule_id' =>1 ),
                array( 'id' => 2,'user_id' => 1,'rule_id' => 13),
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
        Schema::dropIfExists('users_rules');
    }
}
