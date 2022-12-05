<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntityLocalizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entity_localizations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('entity_id');
            $table->string('field');
            $table->integer('lang_id');
            $table->integer('item_id');
            $table->string('value');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entity__localizations');
    }
}
