<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminManagementController extends Controller
{
    public function home(){
        Auth::user()->can('rh') ?: abort(403,'Vc não tem permissão');
        return view('admin.home');
    }


}
