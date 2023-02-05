<?php

namespace App\Http\Controllers;

use App\Models\Reference\RbPrivilege;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;

class Test extends Controller
{
    public function test(){

        $privilege = RbPrivilege::orderBy('id', 'asc')
            ->get('id')
            ->toArray();

        foreach ($privilege as $p) {
            // получаем список пользователей по privilege_id
            $applicants = DB::table('applicant')->where("privilege_id", $p)->get();

            if ($applicants == []){
                continue;
            }

            foreach ($applicants as $applicant) {
                $process = new Process(['php', 'artisan', 'queue:privilege']);
                $process->start();

                $count_raiting = 1;
                while ($process->isRunning()) {
//                    foreach ($applicant as $a) {
                        // Update applicant's raiting
                        DB::table('applicant')
                            ->where('id', $applicant    ->id)
                            ->update(['raiting_privilege_number' => $count_raiting]);
                        $count_raiting++;
//                    }
                    print_r($process->getOutput());
                    $process->stop();
                print_r("success");
                }
            }
        }


















//        $privilege_queue_list = [];
//        foreach ($privilege as $p){
//            $query = User::orderBy('id', 'asc')
//                ->where('privilege_id', $p);
//            $count = 1;
//
//            $arr = $query->get()->toArray();
//
//            for($i = 0; $i < count($arr); $i++){
//                $arr[$i]["raiting_privilege_number"] = $count;
//                $count++;
//            }
//
//            $privilege_queue_list[] = $arr;
//        }
//
//        foreach ($privilege_queue_list as $p){
////            foreach ($p as $user){
////                User::where("id", $user['id'])->update([
////                    "raiting_privilege_number" => $user["raiting_privilege_number"]
////                ]);
////            }
//            if ($p != []){
//                \DB::table('applicant')->update($p);
////                User::query()->update($p);
//            }
//        }
//        return $privilege_queue_list;
    }
}
