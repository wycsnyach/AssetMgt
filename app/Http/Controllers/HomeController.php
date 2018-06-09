<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $roles = Role::where('user_id', $user_id)->first();
        if($roles-> name =="administrator")
        {
            return view('admin_template');
        }
        else
        {
            return view('welcome');
        }
/*
        return $roles;
        return view('home');*/
    }
}
