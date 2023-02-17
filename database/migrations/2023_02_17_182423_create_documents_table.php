<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->nullable()->unique();
            $table->integer('temp_user_id')->unsigned()->index()->nullable()->unique();
            $table->text('resume')->nullable();
            $table->text('pension_application')->nullable();
            $table->text('certificate_of_disability')->nullable();
            $table->text('death_certificate')->nullable();
            $table->text('probation_certificate')->nullable();
            $table->text('verdict_court')->nullable();
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
        Schema::dropIfExists('documents');
    }
}
