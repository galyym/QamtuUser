<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RbFamilyStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rb_family_status', function (Blueprint $table) {
            $table->id()->autoIncrement(); // Идентификатор семейного положения
            $table->string('name_kk'); // Название семейного положения
            $table->string('name_ru'); // Название семейного положения
            $table->text('description_kk')->nullable(); // Краткое описание
            $table->text('description_ru')->nullable(); // Краткое описание
            $table->timestamps(); // Дата создания и дата последнего изменения записи
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rb_family_status');
    }
}
