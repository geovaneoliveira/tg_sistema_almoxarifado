<?php

namespace App\Http\Controllers;
use Request;
use App\Unidade;
use App\Tipo;
use App\Material;
use App\Local;
use App\Estoque;
use App\Inventario;

class InventarioController extends Controller
{

    public $view = [
        "active" => "inventario"
    ];

    public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {

        $estocados = Estoque::listarEstocadosOnde();

        $inventario = Inventario::where('data_fim', '=', null)
        ->orderBy('cod_inventario', 'asc')
        ->count();

        if($inventario == 0){
        return view('inventario')->with('view', $this->view)
        ->with('tipos', Tipo::all())
        ->with('locais', Local::all())
        ->with('estocados', $estocados);
        }
        else{
            $inventario = Inventario::where('data_fim', '=', null)
            ->orderBy('cod_inventario', 'asc')
            ->get();

            return view('inventario')->with('view', $this->view)
            ->with('tipos', Tipo::all())
            ->with('locais', Local::all())
            ->with('estocados', $estocados)
             ->with('inventario', $inventario);
        }

    }

    public function localizaMateriais(){

        $nome_material = Request::input('nome_material');
        $cod_tipo = Request::input('cod_tipo');
        $lote = Request::input('lote');
        $cod_local = Request::input('cod_local');

        $estocados = Estoque::listarEstocadosOnde($nome_material, $cod_tipo, $lote, $cod_local);

	    return view('inventario')
		    	->with('view', $this->view)
		      	->with('tipos', Tipo::all())
		      	->with('locais', Local::all())
		      	->with('estocados', $estocados);

    }

}
