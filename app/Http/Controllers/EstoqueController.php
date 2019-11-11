<?php

namespace App\Http\Controllers;
use App\Estoque;
use App\Local;
use App\Tipo;
use App\Material;
use App\Movimentacao;
use Request;
use App\Http\Requests\EstoqueRequest;


class EstoqueController extends Controller
{

	public $view = array(
    	'active' => 'nula',
    	'operacao' => 'nula'
   	);

	public function __construct()
    {
        $this->middleware('autorizacao');
    }

	public function form() {
		$this->view["active"] = "materiais";

		$material = New Material;
		$locais = Local::all();
		return view('estoque-entrada')->with('view', $this->view)->with('locais', $locais)->with('material', $material);
	}






	public function gerenciar() {
       	$this->view["active"] =  "gerenciarEstoque";

       	$estocados = Estoque::listarEstocadosOnde();

	    return view('estoque-gerenciar')
		    	->with('view', $this->view)
		      	->with('tipos', Tipo::all())
		      	->with('locais', Local::all())
		      	->with('estocados', $estocados);
	}


	public function localiza() {
       	$this->view["active"] = "gerenciarEstoque";

       	$nome_material = Request::input('nome_material');
       	$cod_tipo = Request::input('cod_tipo');
       	$lote = Request::input('lote');
       	$cod_local = Request::input('cod_local');

       	$estocados = Estoque::listarEstocadosOnde($nome_material, $cod_tipo, $lote, $cod_local);

	    return view('estoque-gerenciar')
		    	->with('view', $this->view)
		      	->with('tipos', Tipo::all())
		      	->with('locais', Local::all())
		      	->with('estocados', $estocados);
	}


	public function ajusta() {
       	$this->view["active"] = "gerenciarEstoque";
       	$this->view["operacao"] = "ajusta";
		
		$id = Request::route('id');
		
		$estocado = Estoque::find($id);

		return view('estoque-ajustar')->with('view', $this->view)->with('estocado', $estocado);
	}



		public function edita() {
       	$this->view["active"] = "gerenciarEstoque";
       	$this->view["operacao"] = "edita";
		
		$id = Request::route('id');
		
		$estocado = Estoque::find($id);

		$locais = Local::all();

		return view('estoque-ajustar')->with('view', $this->view)->with('estocado', $estocado)->with('locais', $locais);
	}


	public function atualiza() {
		$this->view["active"] = "gerenciarEstoque";
		
		$id = Request::input('id');
		$estocado = Estoque::find($id);

		if( $estocado->quantidade != Request::input('quantidade') ){
			$this->view["operacao"] = "ajustado";
			$tipo_movimentacao = 'Ajuste';
			$qtde_movimentada = Request::input('quantidade') - $estocado->quantidade;
			
			$movimentacao = new Movimentacao();
			$movimentacao->estoque_id = $estocado->id;
			$movimentacao->cod_usuario = \Auth::user()->id;
			$movimentacao->qtde_movimentada = $qtde_movimentada;
			$movimentacao->tipo_movimentacao = $tipo_movimentacao;
			$movimentacao->save();

			$estocado->quantidade = Request::input('quantidade');
		}else {
			$this->view["operacao"] = "editado";
			$estocado->lote = Request::input('lote');
			$estocado->data_validade = Request::input('data_validade');
			$estocado->cod_local = Request::input('cod_local');
		}
		
		$estocado->save();

		return view('estoque-ajustar')
						->with('view', $this->view)
						->with('tipos', Tipo::all())
		      			->with('locais', Local::all())
		      			->with('estocado', $estocado);
	}


	public function remove() {
		$this->view["operacao"] = "deletado";
		$id = Request::route('id');
		$estocado = Estoque::find($id);

    try {
    	if($estocado->movimentacoes()->count() == 1){
    		$estocado->movimentacoes()->first()->delete();
    	}
    	$estocado->delete();
    } catch (\Illuminate\Database\QueryException $e) {
    	$this->view["operacao"] = "naoDeletado";
    }
		

 		return view('estoque-gerenciar')
		    	->with('view', $this->view)
		      	->with('tipos', Tipo::all())
		      	->with('locais', Local::all())
		      	->with('estocados', Estoque::listarEstocadosOnde())
		      	->with('estocado', $estocado);

		      	
	}





}
