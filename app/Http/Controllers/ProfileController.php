<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }

    public function updatePassword(Request $request)
    {
        $request->validate(
            [
                'current_password' => 'required',
                'new_password' => 'required',
                'new_password_confirmation' => 'required|same:new_password',
            ],
            [
                'current_password.required' => 'A senha atual é obrigatória.',
                'new_password.required' => 'A nova senha é obrigatória.',
                'new_password_confirmation.required' => 'A confirmação da nova senha é obrigatória.',
                'new_password_confirmation.same' => 'A confirmação da senha não confere com a nova senha.',
            ]
        );

        $user = auth()->user();
        if (!password_verify($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'Senha incorreta.');
        }

        $user->password = bcrypt($request->new_password);
        $user->save();
        return redirect()->back()->with('success', 'senha atualizada');
    }

    public function updateUserData(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . auth()->id(),
        ]);

        $user = auth()->user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return redirect()->back()->with('success_change_data', 'Mudança de dados realizada com sucesso.');
    }
}
