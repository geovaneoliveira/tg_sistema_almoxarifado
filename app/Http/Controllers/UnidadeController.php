<?php

namespace App\Http\Controllers;
use App\Unidade;
use Request;
use App\Http\Requests\UnidadesRequest;

class UnidadeController extends Controller
{

	public $view = array(
    	'active' => 'unidade',
    	'operacao' => 'nula',
   	);

	public function __construct()
    {
        $this->middleware('autorizacao');
    }


    public function lista() {
    	$unidades = Unidade::all();
		return view('unidade')->with('unidades', $unidades)->with('view',  $this->view);
	}



	public function adiciona(UnidadesRequest $request) {
		$unidade = new Unidade();
		$unidade->descricao_unid_medida = $request->input('descricao_unid_medida');
		$unidade->save();
		return redirect()
				->action('UnidadeController@lista')
					->withInput(Request::only('descricao_unid_medida'))->with('operacao','incluido');;		
	}


	public function remove() {
		try {
			$id = Request::route('id');
			$unidade = Unidade::find($id);
			$unidade->delete();
			$operacao = "deletado";
	    } catch (\Illuminate\Database\QueryException $e) {
	    	$operacao = "naoDeletado";	    	
	    }
	    

		return redirect('unidade')->with('operacao', $operacao);
	}


	public function edita() {
		$id = Request::route('id');
		$unidade = Unidade::find($id);
		return redirect()->action('UnidadeController@lista')->with('unidade', $unidade)->with('operacao','editar');

	}

	public function atualiza(UnidadesRequest $request) {
		$unidade = Unidade::find($request->input('cod_unid_medida'));
		$unidade->descricao_unid_medida = $request->input('descricao_unid_medida');
		$unidade->save();
		return redirect()
				->action('UnidadeController@lista')
					->withInput(Request::only('descricao_unid_medida'))->with('operacao','atualizado');

	}

}
