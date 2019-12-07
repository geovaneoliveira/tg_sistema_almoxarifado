<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Inventario;
use App\Local;
use Carbon\Carbon;
use App\Estoque;

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

     //   $estocados = Estoque::listarEstocadosOnde();

        return view('adm-inventarios-analisa')
           ->with('view', $this->view)
            ->with('tipos', Tipo::all())
             -> with('locais', Local::all());
    }

    public function abreFormLocaliza() {

       // $inventarios = Inventario::all();
       $cod_resp = Request::input('cod_resp');
       $inventarios = Inventario::where('cod_resp',  'like' , '%' . $cod_resp . '%' );
        $inventarios = $inventarios->orderBy('cod_inventario', 'asc')->get();

        foreach ($inventarios as $LE)
        {
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

        return view('adm-inventarios-localiza')
        ->with('view', $this->view)
          ->with('inventarios', $inventarios);
    }

    public function exibeDetalhes() {







        return view('adm-inventarios-detalhes')
        ->with('view', $this->view)
        ->with('tipos', Tipo::all())
        ->with('locais', Local::all());
    }

public function exibeDetalhesLocalizar(){

return 3;
}



    public function suspender() {

        $id = Request::route('id');
        $inventario = Inventario::find($id);
     //   $inventario->data_fim = Carbon::now()->toDateString();
     //   $inventario->save();
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
      //  $inventario->delete();
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

$estocados = 0;
        return view('adm-inventarios-analisa')
           ->with('view', $this->view)
            ->with('tipos', Tipo::all())
             -> with('locais', Local::all())
              ->with('estocados', $estocados);

    }

}
