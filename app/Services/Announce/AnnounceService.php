<?php

namespace App\Services\Announce;

use App\Models\Announce;
use App\Http\Responders\Responder;
use App\Http\Resources\Announce\AnnouncesResource;
use App\Http\Resources\Announce\AnnounceWithIdRecource;

class AnnounceService
{

    protected $response;
    public function __construct(Responder $response)
    {
        $this->response = $response;
    }

    public function getAnnounceList(){
        $announceList = Announce::orderBy('created_at', 'desc')->simplePaginate(4);
        return $this->response->success('success', AnnouncesResource::collection($announceList)->response()->getData(true));
    }

    public function getAnnounceById($id){
        $announce = Announce::find($id);
        return $this->response->success('success', new AnnounceWithIdRecource($announce));
    }
}
