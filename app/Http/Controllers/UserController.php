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
        // $users = User::all();
        // return view('usuarios-gerenciar')->with('users', $users)->with('view', $this->view);

        return view('usuarios-gerenciar')
                ->with('view', $this->view);
    }


    public function edita() {
        $id = Request::route('id');
        $user = User::find($id);
        return redirect()
                ->action('UserController@gerenciar')
                ->with('user', $user)
                ->with('operacao','editar');

    }

    public function localiza() {
        $permission = Request::input('permission');
        $name = Request::input('name');
        $email = Request::input('email');
        $users = User::where('name', 'like', '%' . $name . '%')
                     ->where('email', 'like', '%' . $email . '%')
                     ->orderBy('name', 'asc');

        if ($permission != -1) {
            $users = $users->where('permission', $permission);
        }

        $users = $users->get();

        return view('usuarios-gerenciar')
                ->with('users', $users)
                ->with('view', $this->view);

    }


    public function atualiza(UsersGerenciarRequest $request) {
        try {
            $user = User::find($request->input('id'));
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->permission = $request->input('permission');
            $user->save();
            return redirect()
                    ->action('UserController@gerenciar')
                    ->with('status','editado');
            
        } catch (\PDOException $e) {
            return redirect()
                    ->action('UserController@gerenciar')
                    ->with('status','naoEditado');            
        }

    }


    public function reseta() {
        try {
            $id = Request::route('id');
            $user = User::find($id);
            $user->password = \Hash::make($user->email);
            $user->save();
            return redirect()
                    ->action('UserController@gerenciar')
                    ->with('status','resetado');            
        } catch (\PDOException $e) {
            return redirect()
                    ->action('UserController@gerenciar')
                    ->with('status','naoResetado');        
        }     

    }


    public function remove() {
        try {
            $id = Request::route('id');
            $user = User::find($id);
            $user->delete();
            return redirect()
                    ->action('UserController@gerenciar')
                    ->with('status','excluido');
        } catch (\PDOException $e) {
            return redirect()
                    ->action('UserController@gerenciar')
                    ->with('status','naoExcluido');
        }
    }


    public function minhaconta() {
        $this->view["active"] = "minhaconta";
        return view('usuarios-minhaconta')
                ->with('view', $this->view);

    }

    public function atualizabyuser(UsersRequest $request) {
        try {
            $user = User::find($request->input('id'));
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = \Hash::make( $request->input('password') );
            $user->save();
            return redirect()
                    ->action('UserController@minhaconta')
                    ->with('status','editado');
            
        } catch (\PDOException $e) {
            return redirect()
                    ->action('UserController@gerenciar')
                    ->with('status','naoEditado');            
        }
    }


}

