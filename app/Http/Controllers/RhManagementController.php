<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RhManagementController extends Controller
{
    public function home(){
        Auth::user()->can('rh') ?: abort(403,'Vc não tem permissão');

        $colaborators = User::with('detail','department')->where('role','colaborator')->withTrashed()->get();
        return view('colaborators.colaborators',compact('colaborators'));
    }
}
