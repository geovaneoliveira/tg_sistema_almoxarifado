<?php

namespace App\Http\Controllers;
use App\User;
use Request;
use App\Http\Requests\UsersRequest;
use App\Http\Requests\UsersGerenciarRequest;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{

    public $view = array(
        'active' => 'gerenciarusuarios',
        'operacao' => 'nula'
    );

    public function __construct()
    {
        $this->middleware('autorizacao');
    }


    public function gerenciar() {
        $users = User::all();
        return view('usuarios-gerenciar')->with('users', $users)->with('view', $this->view);
    }


    public function edita() {
        $id = Request::route('id');
        $user = User::find($id);
        return redirect()->action('UserController@gerenciar')->with('user', $user)->with('operacao','editar');

    }

    public function localiza() {
        $permission = Request::input('permission');
        $name = Request::input('name');
        $email = Request::input('email');
        $users = User::where('permission', $permission)->where('name', 'like', '%' . $name . '%')->where('email', 'like', '%' . $email . '%')
               ->orderBy('name', 'asc')
               ->get();

        return view('usuarios-gerenciar')->with('users', $users)->with('view', $this->view);

    }


    public function atualiza(UsersGerenciarRequest $request) {
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->permission = $request->input('permission');
        $user->save();

        return redirect()
                ->action('UserController@gerenciar')
                    ->withInput(Request::only('name'))->with('operacao','atualizado');

    }


    public function reseta() {
        $id = Request::route('id');
        $user = User::find($id);
        $user->password = \Hash::make($user->email);
        $user->save();
        return redirect()->action('UserController@gerenciar')->with('operacao','resetado');

    }


    public function remove() {
        $id = Request::route('id');
        $user = User::find($id);
        $user->delete();
        return redirect()->action('UserController@gerenciar')->with('operacao','deletado');
    }


    public function minhaconta() {
        $this->view["active"] = "minhaconta";
        return view('usuarios-minhaconta')->with('view', $this->view);

    }

    public function atualizabyuser(UsersRequest $request) {
        $user = User::find($request->input('id'));
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = \Hash::make( $request->input('password') );
        $user->save();
        return redirect()
                ->action('UserController@minhaconta')->with('operacao','atualizado');

    }


}

