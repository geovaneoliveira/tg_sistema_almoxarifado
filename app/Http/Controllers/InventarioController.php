<?php

namespace App\Http\Controllers;
use Request;
use App\Unidade;
use App\Tipo;
use App\Material;
use App\Local;
use App\Estoque;

class InventarioController extends Controller
{

    public $view = [
        "active" => "inventario"
    ];

    public function __construct()
    {
        $this->middleware('autorizacao');
    }

    public function abreForm() {

        $estocados = Estoque::listarEstocadosOnde();



        return view('inventario')->with('view', $this->view)
        ->with('tipos', Tipo::all())
        ->with('locais', Local::all())
        ->with('estocados', $estocados);
    }

}
