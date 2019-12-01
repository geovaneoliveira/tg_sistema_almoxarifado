<?php

namespace App\Http\Controllers;
use App\Tipo;
use Request;
use App\Http\Requests\TiposRequest;

class TipoController extends Controller
{
	public $view = array(
    	'active' => 'tipo',
    	'operacao' => 'nula'
   	);

		public function __construct()
    {
        $this->middleware('autorizacao');
    }


    public function lista() {
    	$tipos = Tipo::all();
		return view('tipo')
				->with('tipos', $tipos)
				->with('view', $this->view);
	}



	public function adiciona(TiposRequest $request) {
		try {
			$nome_tipo = $request->input('nome_tipo');
			$tipoExistente = Tipo::where('nome_tipo', $nome_tipo)->count();
			if($tipoExistente == 0){
				$tipo = new Tipo();
				$tipo->nome_tipo = $request->input('nome_tipo');
				$tipo->save();
				return redirect()
						->action('TipoController@lista')
						->with('tipos', Tipo::all())
						->with('status','incluido')
						->with('view', $this->view);	
			} else {
				return redirect()
						->action('TipoController@lista')
						->with('tipos', Tipo::all())
						->with('status','naoIncluido')
						->with('view', $this->view);
			}			
		} catch (\PDOException $e) {
				return redirect()
						->action('TipoController@lista')
						->with('tipos', Tipo::all())
						->with('status','naoIncluido')
						->with('view', $this->view);			
		}		
	}


	public function remove() {
		try {
			$id = Request::route('id');
			$tipo = Tipo::find($id);
			$tipo->delete();
			return redirect()
					->action('TipoController@lista')
					->with('tipos', Tipo::all())
					->with('status','excluido')
					->with('view', $this->view);
	    } catch (\PDOException $e) {
	    	return redirect()
					->action('TipoController@lista')
					->with('tipos', Tipo::all())
					->with('status','naoExcluido')
					->with('view', $this->view);
	    }
	}


	public function edita() {
		$id = Request::route('id');
		$tipo = Tipo::find($id);
		return redirect()
				->action('TipoController@lista')
				->with('tipo', $tipo)
				->with('operacao','editar');

	}

	public function atualiza(TiposRequest $request) {
		try {
			$tipo = Tipo::find($request->input('cod_tipo'));
			$tipo->nome_tipo = $request->input('nome_tipo');
			$tipo->save();
			return redirect()
					->action('TipoController@lista')
					->with('tipos', Tipo::all())
					->with('status','editado')
					->with('view', $this->view);
			
		} catch (\PDOException $e) {
			return redirect()
					->action('TipoController@lista')
					->with('tipos', Tipo::all())
					->with('status','naoEditado')
					->with('view', $this->view);			
		}
	}

	

}
