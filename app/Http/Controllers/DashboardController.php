<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function indexAction(Request $request){
        return view('home.index');
    }
    public function signupAction(Request $request){
        return view('sign-up');
    }
    public function planAction(Request $request){
        return view('plan');
    }
    public function startAction(Request $request){
        return view('start');
    }
}
