<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColaboratorsControl extends Controller
{
    public function index()
    {
        Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');

        // ->where('role','<>','admin')

        $colaborators = User::with('detail', 'department')
            ->withTrashed()
            ->get();

        return view('colaborators.admin-all-colaborators')->with('colaborators', $colaborators);
    }

    public function verDetalhesUsuario($id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Não esta autorizado.');

        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::with('detail', 'department')
            ->where('id', $id)
            ->first();

        return view('colaborators.show-details')->with('colaborator', $colaborator);
    }

    public function telaDeletarUsuarioSoft($id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Não esta autorizado.');
        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);

        // return view('colaborators.show-details', compact($colaborator));
        return view('colaborators.delete-colaborator-confirm')->with('colaborator', $colaborator);
    }

    public function DeletarUsuarioSoftConfirm($id)
    {
        Auth::user()->can('admin', 'rh') ?: abort(403, 'Não esta autorizado.');
        if (Auth::user()->id === $id) {
            return redirect()->route('home');
        }

        $colaborator = User::findOrFail($id);

        $colaborator->delete();

        return redirect()->route('verTodosUsuarios');
    }

    public function RestoreColaborador($id)
    {
        // Auth::user()->can('admin') ?: abort(403, 'Não esta autorizado.');
        $colaborador = User::withTrashed()->findOrFail($id);
        $colaborador->restore();
        return redirect()->route('verTodosUsuarios');
    }

    public function home()
    {
        Auth::user()->can('colaborator') ?: abort(403, 'Não esta autorizado.');
        $colaborator = User::with('detail', 'department')->where('id', Auth::user()->id)->first();
        //   dd($colaborator->detail);
        return view('colaborators.show-details', compact('colaborator'));
    }
}
