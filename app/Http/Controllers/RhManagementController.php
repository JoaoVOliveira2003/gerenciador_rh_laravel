<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ConfirmAccountEmail;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RhManagementController extends Controller
{
    public function home(){
        Auth::user()->can('rh') ?: abort(403,'Vc não tem permissão');
        $colaborators = User::with('detail','department')->where('role','colaborator')->withTrashed()->get();
        return view('colaborators.colaborators',compact('colaborators'));
    }

    public function newColaborator(){
        Auth::user()->can('rh') ?: abort(403,'Vc não tem permissão');
        // $departments = Department::where('id','>',value: 2)->get();

        $departments = Department::where('id','>',value: 2)->get();


        if($departments->count() === 0){
            abort(403,'Insira mais departamentos');
        }
        return view('colaborators.add-colaborator',compact('departments'));
    }

    public function adicionarColaborador(Request $dados){
         Auth::user()->can('rh') ?: abort(403, 'Não esta autorizado.');

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
        $token = Str::random('50');

        $user = User::create([
            'name' => $dados->name,
            'email' => $dados->email,
            'password' => bcrypt($dados->new_password),
            'role' => 'colaborator',
            'confirmation_token' => $token,
            'permissions' => '["colaborator"]',
            'department_id' => $dados->select_department,
        ]);

        UserDetail::create([
            'user_id' => $user->id,
            'address' => $dados['address'],
            'zip_code' => $dados['zip_code'],
            'city' => $dados['city'],
            'phone' => $dados['phone'],
            'salary' => $dados['salary'],
            'admission_date' => Carbon::createFromFormat('Y-m-d', $dados['admission_date'])->format('Y-m-d'),]);

        //rnviar emial para o user
        Mail::to($user->email)->send(new ConfirmAccountEmail(route('ConfirmAccont', $token)));

        return redirect()->route('rh.management.home');
    }
}
