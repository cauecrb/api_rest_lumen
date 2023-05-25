<?php

namespace App\Http\Controllers;

use App\Http\Controller\Service_ordersController;

class Receive_ordersController extends Controller
{
    public function new(){
        $serviceorders = Service_ordersController::create;
        return response()->json($serviceorders);
    }
}
