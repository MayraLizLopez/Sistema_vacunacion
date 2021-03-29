<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoluntaryController extends Controller
{
    public function register(){
        return view("volunteers.registration");
    }
}
