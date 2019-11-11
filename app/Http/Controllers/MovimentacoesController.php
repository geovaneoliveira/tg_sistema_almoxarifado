<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Local;


class MovimentacoesController extends Controller
{

    public $view = [
        "active" => "movimentacoes"
    ];

    public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {
        return view('movimentacoes')->with('view', $this->view)->with('tipos', Tipo::all())->with('locais', Local::all());
    }

}
