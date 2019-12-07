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

        //$estocados = Estoque::listarEstocadosOnde();

        $inventario = Inventario::where('data_fim', '=', null)
        ->orderBy('cod_inventario', 'asc')
        ->count();

        if($inventario == 0){
        return view('inventario')
                            ->with('view', $this->view)
                            ->with('tipos', Tipo::all())
                        //->with('estocados', $estocados)
                            ->with('locais', Local::all());
        } else {
            $inventario = Inventario::where('data_fim', '=', null)
                                    ->orderBy('cod_inventario', 'asc')
                                    ->get();

            return view('inventario')
                                ->with('view', $this->view)
                                ->with('tipos', Tipo::all())
                                ->with('locais', Local::all())
                                //->with('estocados', $estocados)
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
                                        ->first();

        foreach ($estocados as $e) {
            $e->qtde_contada = null;
            $materialInventariado = Materialinventariado::where('cod_inventario', '=' , $inventario->cod_inventario)
                                        ->where('id_estoque', '=' , $e->id)
                                        ->first();
            if ($materialInventariado) {
                foreach ($materialInventariado->contagens as $co) {
                    if($co->id_contador == \Auth::user()->id ) {
                        $e->qtde_contada = $co->qtde_contada;
                    }
                }
            }                       
        }

        $inventario = Inventario::where('data_fim', '=', null)
                                    ->orderBy('cod_inventario', 'asc')
                                    ->count();

        if($inventario == 0) {
            return view('inventario')
                                ->with('view', $this->view)
                                ->with('tipos', Tipo::all())
                                ->with('locais', Local::all())
                                ->with('estocados', $estocados);
        } else {
            $inventario = Inventario::where('data_fim', '=', null)
                                    ->orderBy('cod_inventario', 'asc')
                                    ->get();

            return view('inventario')
                                ->with('view', $this->view)
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

        $inventario = Inventario::where('data_fim', '=', null)
                                        ->first();

        $materialinventariado = Materialinventariado::where('cod_inventario', '=', $inventario->cod_inventario)
                                                        ->where('id_estoque', '=', $id_estoque)
                                                        ->first();
       
        if($materialinventariado ){ 
            $contagemExistente = Contagem::where('id_matinventariados', '=', $materialinventariado->id)
                                ->where('id_contador', "=", $id_contador)
                                ->first();

            if($contagemExistente) {
                $contagemExistente->qtde_contada = $qtde_contada;
                $contagemExistente->save();
                return "sucesso: contagem exitente";
            } else {                
                $contagem = new Contagem;
                $contagem->qtde_contada = $qtde_contada;
                $contagem->id_contador = $id_contador;
                $contagem->id_matinventariados = $materialinventariado->id;
                $contagem->save();
                return "sucesso: contagem inexitente";
            }            

        } else {
            $materialinventariado = new Materialinventariado;
            $materialinventariado->id_estoque = $id_estoque;
            $materialinventariado->cod_inventario = $inventario->cod_inventario;
            $materialinventariado->save();

            $contagem = new Contagem;
            $contagem->qtde_contada = $qtde_contada;
            $contagem->id_matinventariados = $materialinventariado->id;
            $contagem->id_contador = $id_contador;
            $contagem->save();
            return 'sucesso: material não tinha sido inventariado ainda';
        }


        return 'sucesso: geral';
    }

}
