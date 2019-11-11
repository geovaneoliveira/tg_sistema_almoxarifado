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
		return view('local')->with('locais', $locais)->with('view', $this->view);
	}



	public function adiciona(LocaisRequest $request) {
		$local = new Local();
		$local->nome_local = $request->input('nome_local');
		$local->save();
		return redirect()
				->action('LocalController@lista')
					->withInput(Request::only('nome_local'))->with('operacao','incluido');	
	}


	public function remove() {
		try {
			$id = Request::route('id');
			$local = Local::find($id);
			$local->delete();
			$this->view["operacao"] = "deletado";
	    } catch (\Illuminate\Database\QueryException $e) {
	    	$this->view["operacao"] = "naoDeletado";
	    }
		return view('local')->with('locais', Local::all())->with('view', $this->view);
	}


	public function edita() {
		$id = Request::route('id');
		$local = Local::find($id);
		return redirect()->action('LocalController@lista')->with('local', $local)->with('operacao','editar');

	}

	public function atualiza(LocaisRequest $request) {
		$local = Local::find($request->input('cod_local'));
		$local->nome_local = $request->input('nome_local');
		$local->save();
		return redirect()
				->action('LocalController@lista')
					->withInput(Request::only('nome_local'))->with('operacao','atualizado');

	}

}
