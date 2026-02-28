<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;

class RhUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $colaborators = User::where('role','rh')->get();
        return view('colaborators.rh-users',compact('colaborators'));
    }

    public function telaAdicionarRH(){
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $departments = Department::all();
        return view('colaborators.add-rh-user', compact('departments'));
    }

}
