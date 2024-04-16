<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;

class MyAgentController extends Controller
{
    public function index()
    {
        $agent = new Agent();
        $plataform = $agent->platform();
        $browser = $agent->browser();

        return view('agent.index')->with([
            'plataform' => $plataform,
            'browser' => $browser
        ]);
    }
}
