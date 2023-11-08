<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Verifica se o usuário está autenticado
        if (Auth::check()) {
            // Acessa o usuário autenticado
            $user = Auth::user();
            // Retorna a view 'example-app' e passa os dados do usuário
            return view('example-app', ['user' => $user]);
        }
        // Se o usuário não estiver autenticado, redirecione para a página de login
        return redirect()->route('login');
    }
}
