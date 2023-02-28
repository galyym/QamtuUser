<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RbRequestStatus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("rb_request_status")->insert([
            'name_kk' => 'Өтінім жіберілмеді',
            'name_ru' => 'Заявка не отправлена',
            'description_kk' => 'Жүйеге тіркелді, алайда кезекке тұру бойынша ақпарат толтырған жоқ',
            'description_ru' => 'Зарегистрировался в системе, но не заполнил информацию о постановке в очередь',
        ]);

        DB::table("rb_request_status")->insert([
            'name_kk' => 'Өтініш қарауға арналған',
            'name_ru' => 'Заявление на рассмотрение',
            'description_kk' => 'Өтініш центрге жіберілді',
            'description_ru' => 'Заявка отправлена в центр',
        ]);

        DB::table("rb_request_status")->insert([
            'name_kk' => 'Қабылданбады',
            'name_ru' => 'Отклонен',
            'description_kk' => 'Сіз толтырған мәліметтер арасында қате табылды. Бұл туралы пікірден көре аласыз.',
            'description_ru' => 'Во введенных вами данных обнаружена ошибка. Об этом можно узнать в комментарии.',
        ]);

        DB::table("rb_request_status")->insert([
            'name_kk' => 'Қабылданды',
            'name_ru' => 'Принято',
            'description_kk' => 'Сіздің өтінім ұабылданды, сіз жүйеде кезеккке тұрдыңыз',
            'description_ru' => 'Ваша заявка обработана, вы стоите в очереди в системе',
        ]);
    }
}
