<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table("rb_document_type")->insert([
            'name_kk' => 'Жеке куәлік',
            'name_ru' => 'Удостоверение личности',
            'description_kk' => 'Жеке куәлік',
            'description_ru' => 'Удостоверение личности',
        ]);

        \DB::table("rb_document_type")->insert([
            'name_kk' => 'Паспорт',
            'name_ru' => 'Паспорт',
            'description_kk' => 'Паспорт',
            'description_ru' => 'Паспорт',
        ]);
    }
}
