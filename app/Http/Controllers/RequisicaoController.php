<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;

class RequisicaoController extends Controller
{
    public $view = [
        "active" => "requisicao"
    ];

	public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {
		return view('requisicao')->with('view', $this->view)->with('tipos', Tipo::all())->with('operacao', 'abreForm');
	}

}
