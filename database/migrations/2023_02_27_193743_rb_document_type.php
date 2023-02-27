<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RbDocumentType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rb_document_type', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name_kk');
            $table->string('name_ru');
            $table->text('description_kk')->nullable();
            $table->text('description_ru')->nullable();
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
        Schema::dropIfExists('rb_document_type');
    }
}
