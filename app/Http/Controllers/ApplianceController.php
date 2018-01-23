<?php

namespace App\Http\Controllers;
use App\Appliance;

use Illuminate\Http\Request;

class ApplianceController extends Controller
{
    public function populate(){

        $appliances = DB::table('appliances')->where('unit_id', '=', 2);
        return $appliances;
    }
}
