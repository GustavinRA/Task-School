<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function index(){
        return view('login.index');
    }

    //validando requisição
    public function loginProcess(LoginRequest $request){
        $request->validated();

        // Validar o usuário e a senha com as informações do banco de dados
        $authenticated = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        
        //Verificar se o usuário foi autenticado
        if (!$authenticated) {
            // Redirecionar o usuário para página anterior "login", enviar a mensagem de erro
            return back()->withInput()->with('error', 'Email ou senha inválida');
        }

        //Obter o usuário autenticado
        $user = Auth::user();
        $user = User::find($user->id);

        //Redirect
        return redirect()->route('kanban.index');
    }

    public function destroy(){
        //Deslogar o usuário
        Auth::logout();

        //Redirecionar o usuário, enviar mensagem de sucesso
        return redirect()->route('login')->with('success','Deslogado com sucesso!');
    }

    public function create() {
        //Carregar a VIEW
        return view('login.create');        
    }


}
