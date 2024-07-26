<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GustavoBuilder;

class TestController extends Controller
{
    
    public function index()
    {
        return GustavoBuilder::check();
    }
}
