<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChildsDocIdToTempUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('temp_users', function (Blueprint $table) {
            $table->integer('childs')->nullable();
            $table->integer('document_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('temp_users', function (Blueprint $table) {
//            $table->dropColumn('childs');
            $table->dropColumn('documant_id');
        });
    }
}
