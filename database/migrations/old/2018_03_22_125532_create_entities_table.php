<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::table('entities')->insert(
            array(
                array( 'id' => 1,'name' => 'package_types'),
                array( 'id' => 2,'name' => 'genders'),
                array( 'id' => 3,'name' => 'task_types'),
                array( 'id' => 4,'name' => 'task_statuses'),
                array( 'id' => 5,'name' => 'fixed_pages'),
                array( 'id' => 6,'name' => 'geo_countries'),
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
        Schema::dropIfExists('entities');
    }
}
