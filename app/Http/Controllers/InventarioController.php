<?php

namespace App\Http\Controllers;
use Request;
use App\Tipo;

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
        return view('inventario')->with('view', $this->view);
    }

}
