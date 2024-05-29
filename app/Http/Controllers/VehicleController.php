<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    public function index () {


        $data['vehicles'] = Vehicle::paginate(10);
        return view('vehicle.index', $data);
    }
}
