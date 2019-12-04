<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;
use App\Inventario;
use Carbon\Carbon;

class AdmInventariosController extends Controller
{
        public $view = [
        'active' => 'adm-inventarios',
        'operacao' => 'iniciado'
    ];

    public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {

        $inventario = Inventario::where('data_fim', '=' , null)
        ->orderby('cod_inventario', 'desc')
        ->get();
        if($inventario){
            $status = 'editado';
        }

        return view('adm-inventarios-ativo')
          ->with('view', $this->view)
            ->with('status', $status)
              ->with('operacao', 'abreForm')
                  ->with('inventario', $inventario);
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

    public function suspender() {
        $id = Request::route('id');
        $inventario = Inventario::find($id);
        $inventario->delete();
        return view('adm-inventarios-ativo')
        ->with('view', $this->view);
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

}
