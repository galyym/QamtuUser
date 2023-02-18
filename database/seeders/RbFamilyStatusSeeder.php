<?php

namespace Database\Seeders;

use App\Models\RbFamilyStatus;
use Illuminate\Database\Seeder;

class RbFamilyStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Создаем записи в таблице rb_family_status
        RbFamilyStatus::create([
            'name_kk' => 'Бойдақ',
            'name_ru' => 'Холост',
            'description_kk' => 'Тұрмыс құрмаған немесе үйленбеген',
            'description_ru' => 'Не женат и не состоит в зарегистрированном браке',
        ]);

        RbFamilyStatus::create([
            'name_kk' => 'Отбасылы',
            'name_ru' => 'Женат/Замужем',
            'description_kk' => 'Отбасы құрған',
            'description_ru' => 'В браке, находится под юрисдикцией мужа',
        ]);

        RbFamilyStatus::create([
            'name_kk' => 'Ажырасқан',
            'name_ru' => 'Разведен',
            'description_kk' => 'Заңды түрде ажырасқан',
            'description_ru' => 'Зарегистрированный брак расторгнут',
        ]);

        RbFamilyStatus::create([
            'name_kk' => 'Жесір',
            'name_ru' => 'Вдовец(Вдова)',
            'description_kk' => 'Жолдасынан айрылған',
            'description_ru' => 'Потерял супругу',
        ]);
    }
}
