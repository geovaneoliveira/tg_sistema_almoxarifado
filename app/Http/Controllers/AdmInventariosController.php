<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Inventario;
use App\Local;
use Carbon\Carbon;
use App\Estoque;
use App\Materialinventariado;
use App\Contagem;

class AdmInventariosController extends Controller
{
    public $view = [
      'active' => 'adm-inventarios',
      'operacao' => 'iniciado'
    ];

    public function __construct() {
      $this->middleware('autorizacao');

      if(\App\Inventario::where('data_fim', '=', null)->count() > 0 ) {
        $this->view['inventario'] = true;
      } else {
        $this->view['inventario'] = false;
      }

    }

    public function abreForm() {

      $inventario = Inventario::where('data_fim', '=', null)
                                                      ->orderBy('cod_inventario', 'asc')
                                                      ->count();

      if($inventario == 0) {
        $status = 'nao';

        return view('adm-inventarios-ativo')
                                          ->with('view', $this->view)
                                          ->with('status', $status)
                                          ->with('operacao', 'abredois');
      } else {

        $inventario = Inventario::where('data_fim', '=', null)
                                                ->orderBy('cod_inventario', 'asc')
                                                ->get();
        $status = 'editado';

        foreach ($inventario as $LE) {

          if($LE->data_inicio){
            $dt = Carbon::create($LE->data_inicio);
            $LE->data_inicio = $dt;
            $LE->data_inicio = date_format($LE->data_inicio,"d/m/Y");
          }

          if($LE->data_fim){
            $dt1 = Carbon::create($LE->data_fim);
            $LE->data_fim = $dt1;
            $LE->data_fim = date_format($LE->data_fim,"d/m/Y");
          }

        }

        return view('adm-inventarios-ativo')
                                  ->with('view', $this->view)
                                  ->with('status', $status)
                                  ->with('operacao', 'abreum')
                                  ->with('inventario', $inventario);
      }

    }


    public function abreFormAnalisa() {

     $inventario = Inventario::where('data_fim', '=', null)
     ->first();

     $materialinventariado = Materialinventariado::where('cod_inventario', '=', $inventario->cod_inventario)
     ->orderBy('id_estoque', 'desc')
     ->get();


        return view('adm-inventarios-analisa')
           ->with('view', $this->view)
            ->with('tipos', Tipo::all())
             ->with('locais', Local::all())
              ->with('materialinventariado', $materialinventariado);
    }


    public function abreFormLocaliza() {
      return view('adm-inventarios-localiza')->with('view', $this->view);
    }



    public function localizaInventarios () {
      $nome_respon = Request::input('nome_respon');
      $data_inicio_i = Request::input('data_inicio_i');
      $data_inicio_f = Request::input('data_inicio_f');

      $stmt = Inventario::join('Users', 'inventario.cod_resp', '=', 'Users.id');

      if ($nome_respon) {
        $stmt->where(\DB::Raw('UPPER(Users.name)'),  'like' , '%' . strtoupper($nome_respon) . '%' );
      }

      if ($data_inicio_i) {
        $stmt->whereDate('inventario.data_inicio', '>=', $data_inicio_i);
      }

      if ($data_inicio_f) {
        $stmt->whereDate('inventario.data_inicio', '<=', $data_inicio_f);
      }

      $inventarios = $stmt->orderBy('inventario.cod_inventario', 'desc')->get();

      foreach ($inventarios as $LE) {
        if($LE->data_inicio) {
          $dt = Carbon::create($LE->data_inicio);
          $LE->data_inicio = $dt;
          $LE->data_inicio = date_format($LE->data_inicio,"d/m/Y");
        }

        if($LE->data_fim) {
          $dt1 = Carbon::create($LE->data_fim);
          $LE->data_fim = $dt1;
          $LE->data_fim = date_format($LE->data_fim,"d/m/Y");
        }
      }

      return view('adm-inventarios-localiza')
                                    ->with('inventarios', $inventarios)
                                    ->with('view', $this->view);
    }


    public function exibeDetalhes() {
        $cod_inventario = Request::route('id');

        $inventario = Inventario::find($cod_inventario);
        $nome_material = Request::input('nome_material');
        $cod_tipo = Request::input('cod_tipo');
        $lote = Request::input('lote');
        $cod_local = Request::input('cod_local');

// ARRUMAR A PESQUISA AQUI
        $materiaisinventariados = MaterialInventariado::where('cod_inventario', '=', $inventario->cod_inventario)->get();

            if($inventario->data_inicio){
             $dt = Carbon::create($inventario->data_inicio);
             $inventario->data_inicio = $dt;
             $inventario->data_inicio = date_format($inventario->data_inicio,"d/m/Y");
        }

           if($inventario->data_fim){
            $dt1 = Carbon::create($inventario->data_fim);
        $inventario->data_fim = $dt1;
        $inventario->data_fim = date_format($inventario->data_fim,"d/m/Y");
            }

        return view('adm-inventarios-detalhes')
        ->with('view', $this->view)
        ->with('tipos', Tipo::all())
        ->with('locais', Local::all())
        ->with('inventario', $inventario)
        ->with('materiaisinventariados', $materiaisinventariados);
    }

public function exibeDetalhesLocalizar(){

return 3;
}



    public function suspender() {

        $id = Request::route('id');
        $inventario = Inventario::find($id);

        $materiaisinventariados = MaterialInventariado::where('cod_inventario', '=', $inventario->cod_inventario)
        ->get();

        foreach($materiaisinventariados as $m){
        $contagens = Contagem::where('id_matinventariados', '=', $m->id)->get();

        foreach($contagens as $c){
            $c->delete();
        }
        $m->delete();
        }

        $inventario->delete();

        return redirect()
        ->action('AdmInventariosController@abreForm')
        ->with('view', $this->view)
        ->with('status', 'editado')
        ->with('inventario', $inventario);
    }



    public function iniciar(){

        $inventario = new Inventario();
        $inventario->cod_resp = \Auth::user()->id;
        $inventario->data_inicio = Carbon::now()->toDateString();
        $inventario->save();
        $inventario->get();

        return redirect()
        ->action('AdmInventariosController@abreForm')
        ->with('view', $this->view)
        ->with('status', 'editado')
        ->with('inventario', $inventario);
    }

    public function finalizar(){

// ARRUMAR ESSA PARTE PRA TRAZER O ESTOQUE CERTO, PARECE Q TA TRAZENDO TODOS E ATUALIZANDO A DATA DE TODOS, CONFIRMAR ISSO
        $inventario = Inventario::whereDate('data_fim', '=', null)
        ->orderBy('cod_inventario', 'asc')
        ->get();
        foreach($inventario as $i){
        $i->data_fim = Carbon::now()->toDateString();
        $i->save();

        }


  //      $estocados = Estoque::all();
  //      foreach($estocados as $e){
    //        $e->quantidade = $e->quantidade - 5;
    //        $e->save();
    //    }

        return redirect()
        ->action('AdmInventariosController@abreForm')
        ->with('view', $this->view)
        ->with('status', 'editado')
        ->with('inventario', $inventario);
    }

    public function analisarlocalizar(){

        $nome_material = Request::input('nome_material');
        $cod_tipo = Request::input('cod_tipo');
        $lote = Request::input('lote');
        $cod_local = Request::input('cod_local');
        $contagem = Request::input('contagem');
        $situacao = Request::input('situacao');

        $inventario = Inventario::where('data_fim', '=', null)
         ->first();

        $cod_inventario = $inventario->cod_inventario;

        $materialinventariado = Materialinventariado::listarMateriais($cod_inventario, $nome_material, $lote, $cod_tipo, $cod_local, $contagem, $situacao);

           return view('adm-inventarios-analisa')
              ->with('view', $this->view)
               ->with('tipos', Tipo::all())
                ->with('locais', Local::all())
                 ->with('materialinventariado', $materialinventariado);

    }

}
