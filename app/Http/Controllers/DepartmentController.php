<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;


class DepartmentController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');

        $departamentos = Department::all();
        return view('department.departments', compact('departamentos'));
    }

    public function newDepartment()
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        return view('department.add-department');
    }

    public function gravarDepartament(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');

        $request->validate([
            'name' => 'required|string|max:50|unique:departments'
        ]);

        Department::create(['name' => $request->name]);

        return redirect()->route('departments');
    }

    public function editDepartment($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');

        $qtdeDepartamentos = Department::count();

        if ($qtdeDepartamentos === 1) {
            return redirect()->route('departments');
        } else {
            $departamento = Department::findOrFail($id);
            return view('department.edit-department', compact('departamento'));
        }
    }

    public function updateDepartment(Request $request)
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $qtdeDepartamentos = Department::count();

        if ($qtdeDepartamentos === 1) {
            return redirect()->route('departments');
        } else {
            $id = $request->id;
            $request->validate([
                'id' => 'required',
                'name' => 'required|string|min:3|max:50',
            ]);
            $departamento = Department::findOrFail($id);
            $departamento->update([
                'name' => $request->name
            ]);
            return redirect()->route('departments');
        }
    }

    public function telaDeletarDepartmento($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $qtdeDepartamentos = Department::count();
        if ($qtdeDepartamentos === 1) {
            return redirect()->route('departments');
        } else {
            $departamento = Department::findOrFail($id);
            return view('department.delete-department-confirm', compact('departamento'));
        }
    }

    public function deletarDepartamento($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();
        return redirect()->route('departments')->with('success', 'Departamento deletado com sucesso!');
    }

}
