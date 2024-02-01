<?php

namespace Redninjaturtle\RedLaravelLocation\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LocationsController extends Controller
{

    public function configs()
    {
        $configs = config('locations');
        return view('Location::index')->with(['configs' => $configs]);
    }
}
