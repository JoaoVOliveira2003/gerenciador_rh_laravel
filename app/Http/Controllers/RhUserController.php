<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;

class RhUserController extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $colaborators = User::where('role', 'rh')->get();
        return view('colaborators.rh-users', compact('colaborators'));
    }

    public function telaApagarRH($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $colaborador = User::findOrFail($id);
        return view('colaborators.telaDeletar', compact('colaborador'));
    }

    public function deletarPessoaRH($id)
    {
        $userDetail = UserDetail::where('user_id', $id)->first();

        if ($userDetail) {
            $userDetail->delete();
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('rhUsers');
    }

    public function telaAdicionarRH()
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $departments = Department::all();
        return view('colaborators.add-rh-user', compact('departments'));
    }

    public function gravarUserRH(Request $dados)
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');

        $dados->validate(
            [
                'name' => 'required|string|min:3|max:255',
                'email' => 'required|email|max:255|unique:users,email',
                'select_department' => 'required|integer|exists:departments,id',
                'address' => 'required|string|max:255',
                'zip_code' => 'required|string|min:8|max:9',
                'city' => 'required|string|max:100',
                'phone' => 'required|string|min:10|max:15',
                'salary' => 'required|numeric|min:0',
                'admission_date' => 'required|date|before_or_equal:today',
            ],
            [
                'name.required' => 'O nome é obrigatório.',
                'name.min' => 'O nome deve ter no mínimo 3 caracteres.',
                'email.required' => 'O email é obrigatório.',
                'email.email' => 'Informe um email válido.',
                'select_department.required' => 'Selecione um departamento.',
                'select_department.exists' => 'Departamento inválido.',
                'address.required' => 'O endereço é obrigatório.',
                'zip_code.required' => 'O CEP é obrigatório.',
                'zip_code.min' => 'CEP inválido.',
                'city.required' => 'A cidade é obrigatória.',
                'phone.required' => 'O telefone é obrigatório.',
                'salary.required' => 'O salário é obrigatório.',
                'salary.numeric' => 'O salário deve ser um número.',
                'admission_date.required' => 'A data de admissão é obrigatória.',
                'admission_date.date' => 'Informe uma data válida.',
            ]
        );

        $user = User::create([
            'name' => $dados->name,
            'email' => $dados->email,
            'password' => bcrypt($dados->new_password),
            'role' => 'rh',
            'permissions' => '["rh"]',
            'department_id' => $dados->select_department,
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'address' => $dados['address'],
            'zip_code' => $dados['zip_code'],
            'city' => $dados['city'],
            'phone' => $dados['phone'],
            'salary' => $dados['salary'],
            'admission_date' => Carbon::createFromFormat('Ymd', $dados['admission_date'])
                ->format('Y-m-d'),
        ]);


        return redirect()->route('rhUsers');
    }

    public function telaEditarRH($id)
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $colaborador = User::findOrFail($id);
        $departamento = Department::all();
        $userDetail = UserDetail::where('user_id', $id)->first();
        return view('colaborators.telaEditarRH', compact('colaborador', 'userDetail', 'departamento'));
    }

public function editarUserRH(Request $dados)
{
    Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');

    $dados->validate([
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $dados->id,
        'select_department' => 'required|integer|exists:departments,id',
        'address' => 'required|string|max:255',
        'zip_code' => 'required|string|min:8|max:9',
        'city' => 'required|string|max:100',
        'phone' => 'required|string|min:10|max:15',
        'salary' => 'required|numeric|min:0',
        'admission_date' => 'required|date|before_or_equal:today',
    ]);


    $user = User::findOrFail($dados->id);

    $user->update([
        'name' => $dados->name,
        'email' => $dados->email,
        'role' => 'rh',
        'permissions' => '["rh"]',
        'department_id' => $dados->select_department,
    ]);

   $user->detail()->updateOrCreate(
        ['user_id' => $user->id],
        [
            'address' => $dados->address,
            'zip_code' => $dados->zip_code,
            'city' => $dados->city,
            'phone' => $dados->phone,
            'salary' => $dados->salary,
            'admission_date' => $dados->admission_date,
        ]
    );

    return redirect()->route('rhUsers');
}
}
