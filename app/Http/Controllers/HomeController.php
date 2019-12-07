<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Material;
use App\Estoque;
use App\Requisicao;

class HomeController extends Controller
{
    public $view = [
        "active" => "home"
    ];

    public function __construct(){

        $this->middleware('autorizacao');

        if(\App\Inventario::where('data_fim', '=', null)->count() > 0 ) {
            $this->view['inventario'] = true;
        } else {
            $this->view['inventario'] = false;
        }
        
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuariosSemPermissao = User::where('permission', null)->get();

        $estoquesVencidos = Estoque::join('material', 'estoque.cod_material', '=', 'material.cod_material')
                                        ->whereDate('estoque.data_validade', '<', today()->toDateString() )
                                        ->get();

        $materiaisAbaixoEstoqueMin = Material::materiaisAbaixoEstoqueMin();

        $materiaisAbaixoEstoqueSeg = Material::materiaisAbaixoEstoqueSeg();

        $requisicoesAbertas = Requisicao::where('situacao' , 'Aberta')->get();
   
        return view('home')
            ->with('view', $this->view)
            ->with('usuariosSemPermissao', $usuariosSemPermissao )
            ->with('estoquesVencidos', $estoquesVencidos )
            ->with('materiaisAbaixoEstoqueMin', $materiaisAbaixoEstoqueMin )
            ->with('materiaisAbaixoEstoqueSeg', $materiaisAbaixoEstoqueSeg )
            ->with('requisicoesAbertas', $requisicoesAbertas );
    }
}
