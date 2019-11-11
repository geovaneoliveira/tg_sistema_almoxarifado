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
		return view('tipo')->with('tipos', $tipos)->with('view', $this->view);
	}



	public function adiciona(TiposRequest $request) {
		$tipo = new Tipo();
		$tipo->nome_tipo = $request->input('nome_tipo');
		$tipo->save();
		return redirect()
				->action('TipoController@lista')
					->withInput(Request::only('nome_tipo'))->with('operacao','incluido');		
	}


	public function remove() {
		$id = Request::route('id');
		$tipo = Tipo::find($id);
		$tipo->delete();
		return redirect()->action('TipoController@lista');
	}


	public function edita() {
		$id = Request::route('id');
		$tipo = Tipo::find($id);
		return redirect()->action('TipoController@lista')->with('tipo', $tipo)->with('operacao','editar');

	}

	public function atualiza(TiposRequest $request) {
		$tipo = Tipo::find($request->input('cod_tipo'));
		$tipo->nome_tipo = $request->input('nome_tipo');
		$tipo->save();
		return redirect()
				->action('TipoController@lista')
					->withInput(Request::only('nome_tipo'))->with('operacao','atualizado');

	}

}
