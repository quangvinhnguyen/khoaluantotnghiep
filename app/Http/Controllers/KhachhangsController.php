<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
class KhachhangsController extends Controller
{
    //

    public function index(){
    	return view('UI.layout');
    }

    public function store(){
    	echo "oke";
    }


    public function showLoginForm(){
    	return view('UI.trangchu.login');
    }

        public function getInfo()
    {
        $users =  DB::table('khachhangs')->find(Auth::guard('khachhangs')->id());
        return view('UI.customInfo', compact('users'));
    }

    public function getchangepassword()
    {
        return view('UI.changepassword');
    }

    public function edit($id)
    {
        $user = DB::table('khachhangs')->find($id);
        dd($user);

    }
}
