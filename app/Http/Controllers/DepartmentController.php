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

    public function newDepartment(){
       Auth::user()->can('admin') ?: abort(403,'Não esta autorizado.');
       return view('department.add-department');
    }

    public function gravarDepartament(Request $request){
       Auth::user()->can('admin') ?: abort(403,'Não esta autorizado.');
        $request->validate([
            'name'=>'required|string|max:50|unique:departments'
        ]);

        Department::create(['name'=>$request->name]);

        return redirect()->route('departments');
    }
}
