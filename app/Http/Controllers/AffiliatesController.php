<?php

namespace App\Http\Controllers;


use Illuminate\Routing\Controller as BaseController;
use App\Service\AffiliatesService as Service;

class AffiliatesController extends BaseController
{
    public function __construct(Service $service) 
    {
      $this->service = $service;
    }

    public function getNear()
    {
      $data =  $this->service->getAllAffiliatesByFile();
      return response()->json($data);
    }
}
