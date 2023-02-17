<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInfoToApplicantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applicant', function (Blueprint $table) {
            $table->tinyInteger('family_status')->nullable()->comment('Семейный положение');
            $table->tinyInteger('document_type')->nullable()->comment('Тип документа');
            $table->string('document_number', 255)->nullable();
            $table->string('document_exp', 255)->nullable();
            $table->string('document_issued', 255)->nullable();
            $table->text('address_reg')->nullable()->comment('Юридический документа');
            $table->tinyInteger('education_type')->nullable();
            $table->string('education_org', 255)->nullable();
            $table->string('education_year_finish', 255)->nullable()->comment('до **** года');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applicant', function (Blueprint $table) {
            //
        });
    }
}
