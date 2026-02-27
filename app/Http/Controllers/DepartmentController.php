<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(){
        Auth::user()->can('admin') ?: abort(403,'Não esta autorizado.');

        $departamentos = Department::all();
        return view('department.departments',compact('departamentos'));
    }

}
