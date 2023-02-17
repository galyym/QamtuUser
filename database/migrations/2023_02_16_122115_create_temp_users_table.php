<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTempUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temp_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('raiting_number')->length(11)->default(0)->comment('Порядковый номер для ранжировании');
            $table->integer('raiting_privilege_number')->nullable()->comment(' ');
            $table->integer('status_id')->length(10)->default(1)->comment('Статус (rb_applicant_statuses.id)');
            $table->unsignedBigInteger('iin')->default('000000000000')->comment(' ')->unique();
            $table->string('full_name', 128)->nullable()->comment('ФИО');
            $table->date('birthdate')->default('1900-01-01')->comment(' ');
            $table->integer('privilege_id')->length(3)->default(1)->comment('Тип льготы (rb_privileges.id)');
            $table->text('positions_string')->nullable()->comment(' ');
            $table->string('positions', 255)->default('@1@')->comment('Позиции');
            $table->string('email', 128)->nullable()->comment('Электронная почта');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->nullable()->default('$2y$10$NjSROq1vooUXGU1CpIOI2.9C3zqgpBrB3DohgUdyTQH6tRl6QRxWa');
            $table->string('phone_number', 15)->nullable()->comment('Номер телефона');
            $table->string('address', 128)->nullable()->comment('Адрес проживания');
            $table->string('second_phone_number', 128)->nullable()->comment('Другие номера телефона');
            $table->tinyInteger('is_have_whatsapp')->default(0)->comment('Есть ли Whats App?');
            $table->tinyInteger('is_have_telegram')->default(0)->comment('Есть ли телеграмм?');
            $table->string('comment', 255)->nullable()->comment('Комментарии');
            $table->timestamp('last_visit')->nullable()->comment('Последний вход в систему');
            $table->text('firebase_token')->nullable()->comment('firebase_token для уведомления');
            $table->string('remember_token', 100)->nullable()->comment(' ');
            $table->string('year', 100)->nullable()->comment(' ');
            $table->timestamps();
            $table->tinyInteger('family_status')->nullable()->comment('Семейный положение');
            $table->tinyInteger('document_type')->nullable()->comment('Тип документа');
            $table->string('document_number', 255)->nullable()->comment(' ');
            $table->string('document_exp', 255)->nullable()->comment(' ');
            $table->string('document_issued', 255)->nullable()->comment(' ');
            $table->text('address_reg')->nullable()->comment('Юридический документа');
            $table->tinyInteger('education_type')->nullable()->comment(' ');
            $table->string('education_org', 255)->nullable()->comment(' ');
            $table->string('education_year_finish', 255)->nullable()->comment('до **** года');
            $table->tinyInteger('request_status_id')->nullable()->default(1)->comment('Статус заявления. 1-заявка не отправлена, 2-заявка на рассмотрения, 3-заявка отказано, 4-заявка принято');
        });
        DB::statement('ALTER TABLE temp_users MODIFY iin BIGINT(12) UNSIGNED ZEROFILL NOT NULL DEFAULT 000000000000');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('temp_users');
    }
}
