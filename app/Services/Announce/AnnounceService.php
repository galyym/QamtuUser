<?php

namespace App\Services\Announce;

use App\Http\Resources\Announce\AnnounceResource;
use App\Models\Announce;

class AnnounceService
{

    public function getAnnounceList(){
        return AnnounceResource::collection(Announce::paginate(10));
    }

    public function getAnnounceById($id){
        return Announce::find($id);
    }
}
