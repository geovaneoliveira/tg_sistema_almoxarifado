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

        $movimentados = Movimentacao::listarMovimentacao();

        return view('movimentacoes')
               ->with('view', $this->view)
                ->with('tipos', Tipo::all())
                ->with('locais', Local::all())
                 ->with('movimentados', $movimentados);
    }


    public function localiza(){
        $this->view["active"] = "movimentacoes";

        $nome_material = Request::input('nome_material');
        $lote = Request::input('lote');
        $tipo_movimentacao = Request::input('tipo_movimentacao');
        $cod_local = Request::input('cod_local');
        $data_mov = Request::input('data_mov');
        $qtde_movimentada = Request::input('qtde_movimentada');
        $cod_usuario  = Request::input('cod_usuario');
        $cod_requisicao = Request::input('cod_requisicao');

      $movimentados = Movimentacao::listarMovimentacao($nome_material, $lote, $tipo_movimentacao, $cod_local, $data_mov, $qtde_movimentada, $cod_usuario, $cod_requisicao);

        return view('movimentacoes')
                ->with('view', $this->view)
                ->with('tipos', Tipo::all())
                ->with('locais', Local::all())
                ->with('movimentados', $movimentados);
    }



}
