<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\TruckType;

class WelcomeController extends Controller
{
    public function index()
    {
        \Artisan::call('optimize');
        return view('welcome');

    }// end of index

}//end of controller
