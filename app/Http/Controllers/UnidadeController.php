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
		return view('unidade')
				->with('unidades', $unidades)
				->with('view',  $this->view);
	}



	public function adiciona(UnidadesRequest $request) {
		try {
			$descricao_unid_medida = $request->input('descricao_unid_medida');
			$unidadeExistente = Unidade::where('descricao_unid_medida', $descricao_unid_medida)->count();
			if($unidadeExistente == 0){
				$unidade = new Unidade();
				$unidade->descricao_unid_medida = $request->input('descricao_unid_medida');
				$unidade->save();
				return redirect()
						->action('UnidadeController@lista')
						->with('unidades', Unidade::all())
						->with('status','incluido')
						->with('view', $this->view);	
			} else {
				return redirect()
						->action('UnidadeController@lista')
						->with('unidades', Unidade::all())
						->with('status','naoIncluido')
						->with('view', $this->view);
			}			
		} catch (\PDOException $e) {
				return view('unidade')
						->with('unidades', Unidade::all())
						->with('status','naoIncluido')
						->with('view', $this->view);			
		}			
	}


	public function remove() {
		try {
			$id = Request::route('id');
			$unidade = Unidade::find($id);
			$unidade->delete();
			return redirect()
					->action('UnidadeController@lista')
					->with('unidades', Unidade::all())
					->with('status','excluido')
					->with('view', $this->view);
	    } catch (\PDOException $e) {
	    	return redirect()
					->action('UnidadeController@lista')
					->with('unidades', Unidade::all())
					->with('status','naoExcluido')
					->with('view', $this->view);
	    }	
	}


	public function edita() {
		$id = Request::route('id');
		$unidade = Unidade::find($id);
		return redirect()
				->action('UnidadeController@lista')
				->with('unidade', $unidade)
				->with('operacao','editar');

	}

	public function atualiza(UnidadesRequest $request) {
		try {
			$unidade = Unidade::find($request->input('cod_unid_medida'));
			$unidade->descricao_unid_medida = $request->input('descricao_unid_medida');
			$unidade->save();
			return redirect()
					->action('UnidadeController@lista')
					->with('unidades', Unidade::all())
					->with('status','editado')
					->with('view', $this->view);
			
		} catch (\PDOException $e) {
			return redirect()
					->action('UnidadeController@lista')
					->with('unidades', Unidade::all())
					->with('status','naoEditado')
					->with('view', $this->view);			
		}
	}

}
