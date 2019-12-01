<?php

namespace App\Http\Controllers;
use App\Local;
use Request;
use App\Http\Requests\LocaisRequest;


class LocalController extends Controller
{
	public $view = array(
    	'active' => 'local',
    	'operacao' => 'nula'
   	);

	public function __construct()
    {
        $this->middleware('autorizacao');
    }


    public function lista() {
    	$locais = Local::all();
		return view('local')
				->with('locais', $locais)
				->with('view', $this->view);
	}



	public function adiciona(LocaisRequest $request) {
		$nome_local = $request->input('nome_local');
		$localExistente = Local::where('nome_local', $nome_local)->count();
		//$locaisPesquisado = Local::where('nome_local', 'like' , '%' . $nome_local . '%' )->get();
		if($localExistente == 0){
			$local = new Local();
			$local->nome_local = $request->input('nome_local');
			$local->save();
			return redirect()
				->action('LocalController@lista')
					->with('locais', Local::all())
					->with('status','incluido')
					->with('view', $this->view);	
		} else {
			return redirect()
				->action('LocalController@lista')
					->with('locais', Local::all())
					->with('status','naoIncluido')
					->with('view', $this->view);
		}
		
	}


	public function remove() {
		try {
			$id = Request::route('id');
			$local = Local::find($id);
			$local->delete();
			return redirect()
				->action('LocalController@lista')
					->with('locais', Local::all())
					->with('status','excluido')
					->with('view', $this->view);
	    } catch (\PDOException $e) {
	    	return redirect()
				->action('LocalController@lista')
					->with('locais', Local::all())
					->with('status','naoExcluido')
					->with('view', $this->view);
	    }		
	}


	public function edita() {
		$id = Request::route('id');
		$local = Local::find($id);
		return redirect()
				->action('LocalController@lista')
				->with('local', $local)
				->with('operacao','editar');
	}

	public function atualiza(LocaisRequest $request) {
		try {
			$local = Local::find($request->input('cod_local'));
			$local->nome_local = $request->input('nome_local');
			$local->save();
			return redirect()
				->action('LocalController@lista')
					->with('locais', Local::all())
					->with('status','editado')
					->with('view', $this->view);
			
		} catch (\PDOException $e) {
			return redirect()
				->action('LocalController@lista')
					->with('locais', Local::all())
					->with('status','naoEditado')
					->with('view', $this->view);			
		}
	}

}
