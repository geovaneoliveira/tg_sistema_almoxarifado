<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;

class AdmInventariosController extends Controller
{
        public $view = [
        "active" => "adm-inventarios"
    ];

    public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {
        return view('adm-inventarios-ativo')->with('view', $this->view)->with('operacao', 'abreForm');
    }


    public function abreFormAnalisa() {
        return view('adm-inventarios-analisa')->with('view', $this->view);
    }

    public function abreFormLocaliza() {
        return view('adm-inventarios-localiza')->with('view', $this->view);
    }

        public function exibeDetalhes() {
        return view('adm-inventarios-detalhes')->with('view', $this->view);
    }
}
