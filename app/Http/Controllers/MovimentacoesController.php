<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Local;
use App\Movimentacao;


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


    public function localiza(){
        //gustavo trabalhar aqui!!
        //isso é soh um teste para ver se esta retornando
        return Movimentacao::listarMovimentacao();

    }


}
