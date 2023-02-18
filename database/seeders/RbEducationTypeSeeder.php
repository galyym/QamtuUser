<?php

namespace Database\Seeders;

use App\Models\RbEducationType;
use App\Models\RbFamilyStatus;
use Illuminate\Database\Seeder;

class RbEducationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RbEducationType::create([
            'name_kk' => 'Жоғарғы',
            'name_ru' => 'Высшее',
            'description_kk' => 'Университетте немесе институтта алған білімнің ең жоғары деңгейі',
            'description_ru' => 'Наивысший уровень образования, полученный в университете или институте',
        ]);

        RbEducationType::create([
            'name_kk' => 'Арнайы орта',
            'name_ru' => 'Среднее специальное',
            'description_kk' => 'Колледж немесе техникум білімі',
            'description_ru' => 'Образование, полученное в колледже или техникуме',
        ]);

        RbEducationType::create([
            'name_kk' => 'Орта',
            'name_ru' => 'Среднее',
            'description_kk' => 'Мектепте алған негізгі білім',
            'description_ru' => 'Базовое образование, полученное в школе',
        ]);
    }
}
