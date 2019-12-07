<?php

namespace App\Http\Controllers;
use Request;
use App\Unidade;
use App\Tipo;
use App\Material;
use App\Local;
use App\Estoque;
use App\Inventario;
use App\Contagem;
use App\Materialinventariado;

class InventarioController extends Controller
{

    public $view = [
        "active" => "inventario"
    ];

    public function __construct(){

        $this->middleware('autorizacao');

        if(\App\Inventario::where('data_fim', '=', null)->count() > 0 ) {
            $this->view['inventario'] = true;
        } else {
            $this->view['inventario'] = false;
        }

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

//	    return view('inventario')
	//	    	->with('view', $this->view)
	 //     	->with('tipos', Tipo::all())
	//	      	->with('locais', Local::all())
	//	      	->with('estocados', $estocados);

    }


    public function contagem(){
        $id_estoque = Request::route('id');
        $qtde_contada = Request::route('qtde_contada');
        $id_contador = \Auth::user()->id;

        $inventario = Inventario::whereDate('data_fim', '=', null)
        ->first();

        $materialinventariado = MaterialInventariado::where('cod_inventario', '=', $inventario->cod_inventario)
        ->where('id_estoque', '=', $id_estoque)->first();

        return 'sucesso';

        if($materialinventariado){
        $contagem = new Contagem;
        $contagem->qtde_contada = $qtde_contada;
        $contagem->id_contador = $id_contador;
        $contagem->id_matinventariado = $materialinventariado->id;
        $contagem->save();
        } else{
            $materialinventariado = new MaterialInventariado;
            $materialinventariado->id_estoque = $id_estoque;
            $materialinventariado->cod_inventario = $inventario->cod_inventario;
            $materialinventariado->save();

            $contagem = new Contagem;
            $contagem->qtde_contada = $qtde_contada;
            $contagem->id_matinventariado = $materialinventariado->id;
            $contagem->id_contador = $id_contador;
            $contagem->save();
        }


        return 'sucesso';
    }

}
