<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsIsAdvertisedAndViewsAndGradeIdToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_advertised')->after('is_active')->default(false);
            $table->integer('views')->after('device_token')->unsigned()->default(0);
            $table->integer('degree_id')->after('views')->unsigned()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_advertised');
            $table->dropColumn('views');
            $table->dropColumn('degree_id');
        });
    }
}
