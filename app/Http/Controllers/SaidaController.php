<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Requisicao;
use App\User;
use App\Estoque;
use App\Movimentacao;
use Carbon\Carbon;



class SaidaController extends Controller
{
    public $view = [
        "active" => "saida"
    ];


	public function __construct()
    {
        $this->middleware('autorizacao');
    }


    public function abreForm() {
		return view('saida-consulta-de-requisicoes')
                ->with('view', $this->view);
	}


    public function localiza() {
        $nome_requisitante = Request::input('nome_requisitante');
        $cod_requisicao = Request::input('cod_requisicao');
        $situacao = Request::input('situacao');
        $data_req_inicial = Request::input('data_req_inicial');
        $data_req_final = Request::input('data_req_final');
        $data_atend_inicial = Request::input('data_atend_inicial');
        $data_atend_final = Request::input('data_atend_final');

        $requisicoes = Requisicao::where('cod_requisicao',  'like' , '%' . $cod_requisicao . '%' );

        if ($nome_requisitante) {
            $requisitantes = User::where(\DB::Raw('UPPER(name)'), 'like', '%' . strtoupper($nome_requisitante) . '%')
                                ->select('id')
                                ->get();
            $requisicoes->whereIn('cod_usuario',  $requisitantes);
        }

        if ($situacao) {
            $requisicoes->where('situacao', $situacao);
        }

        if ($data_req_inicial) {
            $requisicoes->whereDate('data_req', '>=', $data_req_inicial);
        }

        if ($data_req_final) {
            $requisicoes->whereDate('data_req', '<=', $data_req_final);
        }

        if ($data_atend_inicial) {
            $requisicoes->whereDate('data_atend', '>=', $data_atend_inicial);
        }

        if ($data_atend_final) {
            $requisicoes->whereDate('data_atend', '<=', $data_atend_final);
        }

        $requisicoes = $requisicoes->orderBy('cod_requisicao', 'desc')->get();

        return view('saida-consulta-de-requisicoes')
                ->with('view', $this->view)
                ->with('requisicoes', $requisicoes);

    }


    public function atende() {
        $cod_requisicao = Request::route('cod_requisicao');
        $requisicao = Requisicao::find($cod_requisicao);

        return view('saida-atender-requisicao')
                    ->with('view', $this->view)
                    ->with('requisicao', $requisicao)
                    ;
    }


    public function nega() {
        $cod_requisicao = Request::route('cod_requisicao');
        $requisicao = Requisicao::find($cod_requisicao);
        try {

            if( $requisicao->situacao == 'Aberta'){
                $requisicao->situacao = 'Negada';
                $requisicao->save();
                return redirect()
                    ->action('SaidaController@abreForm')
                    ->with('status', 'negada');
            } elseif( $requisicao->situacao == 'Negada'){
                $requisicao->situacao = 'Aberta';
                $requisicao->save();
                return redirect()
                        ->action('SaidaController@abreForm')
                        ->with('status', 'aberta');
            }


        } catch (\PDOException $e) {
            if( $requisicao->situacao == 'Aberta'){
                return redirect()
                    ->action('SaidaController@abreForm')
                    ->with('status', 'aberta');
            } else if( $requisicao->situacao == 'Negada'){
                return redirect()
                    ->action('SaidaController@abreForm')
                    ->with('status', 'naoAberta');
            }
        }
    }


    public function exibeDetalhes() {
        $cod_requisicao = Request::route('cod_requisicao');
        $requisicao = Requisicao::find($cod_requisicao);
        return view('requisicao-detalhes')
                        ->with('view', $this->view)
                        ->with('requisicao', $requisicao);
    }


    public function localizaMateriaisRequisitadosComEstoques() {
        $cod_requisicao = Request::route('cod_requisicao');
        $requisicao = Requisicao::find($cod_requisicao);

        foreach ($requisicao->materiais_requisitados as $m) {
            $m->material->unidade;
            $m->material->calcQtdeTotal = $m->material->calcQtdeTotal();
            foreach ($m->material->estoques as $e) {
                $e->local;
                $e->get_data_atend_formatada = $e->get_data_atend_formatada();
            }
        }
        return response()->json($requisicao);
    }




    public function finaliza() {
        $jsonRequisicaoAtendidaRec = Request::getContent();
        $requisicaoAtendidaRec = json_decode($jsonRequisicaoAtendidaRec);

        $retorno = [
            "status"    =>  "Erro",
            "msg"       =>  "Aconteceu um erro inesperado ao processar as saídas da requisição!"
        ];


        //validações
        $requisicaoValida = true;
        $requisicaoZerada = true;
        foreach ($requisicaoAtendidaRec->materiais_requisitados as $mr) {
            $qtdeSaidaTotal = 0;
            foreach ($mr->material->estoques as $e) {
                $estoque = Estoque::find($e->id);
                //verificando se não está tentando antender uma requisição que já tem movimentações, ou seja, já foi atendida.
                foreach ($estoque->movimentacoes as $mov) {
                    if($mov->cod_requisicao == $requisicaoAtendidaRec->cod_requisicao ){
                        $requisicaoValida = false;
                        $retorno = ["status" => "Erro", "msg" => "A requisição não pode ser processada por já ter sido processada previamente!"];
                    }
                }
                //verificando se é um valor numerico válido, se a quantidade em estoque é suficiente
                if ( !(is_numeric($e->qtdeSaida)) || $e->qtdeSaida > $estoque->quantidade || $e->qtdeSaida < 0) {
                    $requisicaoValida = false;
                    $retorno = ["status" => "Erro", "msg" => "A requisição não pode ser processada devido a quantidades inválidas ou não há estoque suficiente"];
                }
                if($e->qtdeSaida  > 0) {
                    $requisicaoZerada = false;
                }

                $qtdeSaidaTotal += $e->qtdeSaida;
            }
            //tentando dar saida em uma quantidade maior do que a requisitada
            if($qtdeSaidaTotal > $mr->quantidade_req){
                $requisicaoValida = false;
                $retorno = ["status" => "Erro", "msg" => "A requisição não pode ser processada pois as quantidades de saída excedem a requisitada!"];
            }
        }

        if($requisicaoZerada == true) {
            $requisicaoValida = false;
            $retorno = [ "status" => "Erro", "msg" => "A requisição não possui nenhum material para ser processado!" ];
        }

        //se valida, modifica-la e movimentaar material

        if($requisicaoValida == true){
            try {
                //instanciar requisição, mudar situacao para finalizada, adicionar data de atendimento. Deixar para salvar soh no fim
                $requisicaoAtendida = Requisicao::find($requisicaoAtendidaRec->cod_requisicao);
                $requisicaoAtendida->situacao = "Finalizada";
                $requisicaoAtendida->data_atend = Carbon::today();
                $requisicaoAtendida->save();

                //movimentações
                foreach ($requisicaoAtendidaRec->materiais_requisitados as $mr) {
                    foreach ($mr->material->estoques as $e) {
                        $estoque = Estoque::find($e->id);
                        $estoque->quantidade -= $e->qtdeSaida;
                        $estoque->save();
                        if( $e->qtdeSaida > 0 ){
                            $movimentacao = new Movimentacao();
                            $movimentacao->qtde_movimentada = $e->qtdeSaida * (-1);
                            $movimentacao->tipo_movimentacao = "Requisição" ;
                            $movimentacao->estoque_id = $e->id;
                            $movimentacao->cod_usuario = \Auth::user()->id;
                            $movimentacao->cod_requisicao = $requisicaoAtendidaRec->cod_requisicao;
                            $movimentacao->save();
                        }
                    }
                }
            $retorno = ["status" => "Sucesso", "msg" => "Requisição finalizada com sucesso"];
            } catch (\PDOException $e) {
                $retorno = ["status" => "Erro", "msg" => "Aconteceu um erro inesperado ao processar a saída da requisição!"];
            }
        }

        return $retorno;
    }












}
