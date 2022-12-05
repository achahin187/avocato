<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackageTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('package_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        DB::table('package_types')->insert(
            array(
                array( 'id' => 1,'name' => 'platinum'),
                array( 'id' => 2,'name' => 'gold'),
                array( 'id' => 3,'name' => 'silver'),
                array( 'id' => 4,'name' => 'bronze'),
                array( 'id' => 5,'name' => 'other'),
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
        Schema::dropIfExists('package__types');
    }
}
