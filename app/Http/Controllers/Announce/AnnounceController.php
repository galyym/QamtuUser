<?php

namespace App\Http\Controllers\Announce;

use App\Http\Controllers\Controller;
use App\Services\Announce\AnnouncesResource;
use Illuminate\Http\Request;
use App\Services\Announce\AnnounceService as Service;
use Illuminate\Support\Facades\Auth;

class AnnounceController extends Controller
{
    protected $service;

    public function __construct(Service $service){
        $this->service = $service;
    }

    public function getAnnounceList() {
        return $this->service->getAnnounceList();
    }

    public function getAnnounceById($lang, int $id) {
        return $this->service->getAnnounceById($id);
    }
}
