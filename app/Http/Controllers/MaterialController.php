<?php

namespace App\Http\Controllers;
use DB;
use Request;
use App\Unidade;
use App\Tipo;
use App\Material;
use App\Estoque;
use App\Movimentacao;
use App\Local;
use App\Http\Requests\MateriaisRequest;
use App\Http\Requests\EstoqueRequest;


class MaterialController extends Controller
{
    public $view = array(
        'active' => 'materiais',
        'operacao' => 'nula'
    );


	public function __construct()
    {
        $this->middleware('autorizacao');
    }

	public function novo() {
        return view('material')
                ->with('view', $this->view)
                ->with('unidades', Unidade::all())
                ->with('tipos', Tipo::all());
    }

    public function adiciona(MateriaisRequest $request) {
        try {
            $nome_material = $request->input('nome_material');
            $materialExistente = Material::where('nome_material', $nome_material)->count();
            if($materialExistente == 0){
            Material::create($request->all());//com validação
            return redirect()
                    ->action('MaterialController@consulta')
                    ->with('status','incluido')
                    ->with('view', $this->view);
            } else {
            return redirect()
                    ->action('MaterialController@novo')
                    ->with('status','naoIncluido')
                    ->with('view', $this->view);
            }
        } catch (\PDOException $e) {
            return redirect()
                    ->action('MaterialController@novo')
                    ->with('status','naoIncluido')
                    ->with('view', $this->view);
        }




    }

    public function consulta() {
        //$Materiais = Material::all();

        return view('material-consulta')
                ->with('view', $this->view)
                ->with('tipos', Tipo::all());
              //  ->with('materiais', $Materiais);
    }

    public function edita() {
		$id = Request::route('id');
        $material= Material::find($id);
        return redirect()
                ->action('MaterialController@novo')
                ->with('material', $material)
                ->with('view', $this->view)
                ->with('operacao','editar');
    }

    public function remove() {
        try {
            $id = Request::route('id');
            $material = Material::find($id);
            $material->delete();
            if ($material){
                $res=Material::where('cod_material',$id)->delete();
                return redirect()
                        ->action('MaterialController@consulta')
                        ->with('status','excluido');
            } else {
                return redirect()
                    ->action('MaterialController@consulta')
                    ->with('status','naoExcluido');
            }
        } catch (\PDOException $e) {
            return redirect()
                    ->action('MaterialController@consulta')
                    ->with('status','naoExcluido');
        }
	}


    public function atualiza(MateriaisRequest $request) {
        try {
            $material = Material::find($request->input('cod_material'));
            $material->cod_material = $request->input('cod_material');
            $material->nome_material = $request->input('nome_material');
            $material->cod_tipo = $request->input('cod_tipo');
            $material->cod_unid_medida = $request->input('cod_unid_medida');
            $material->lead_time = $request->input('lead_time');
            $material->cons_dia = $request->input('cons_dia');
            $material->percentual_seg = $request->input('percentual_seg');
            $material->margem_seg = $request->input('margem_seg');
            $material->save();
            return redirect()
                    ->action('MaterialController@consulta')
                    ->with('status','editado');

        } catch (\PDOException $e) {
            return redirect()
                    ->action('MaterialController@novo')
                    ->with('status','naoEditado');
        }
    }


    public function localiza() {
        $nome_material = Request::input('nome_material');
        $tipo = Request::input('cod_tipo');

        if ($nome_material){
            if ($tipo){
                $Materiais = Material::where('cod_tipo', $tipo)
                                        ->where(\DB::Raw('UPPER(nome_material)'), 'like', '%' . strtoupper($nome_material) . '%')
                                        ->orderby('cod_material', 'desc')
                                        ->get();
            }
            else{
                $Materiais = Material::where(\DB::Raw('UPPER(nome_material)'), 'like', '%' . strtoupper($nome_material) . '%')
                                        ->orderby('cod_material', 'desc')
                                        ->get();
            }
        }
        elseif($tipo){
            $Materiais = Material::where('cod_tipo', $tipo)
                                    ->orderby('cod_material', 'desc')
                                    ->get();

        }
        else{
            $Materiais = Material::all();
        }

         return view('material-consulta')
                    ->with('view', $this->view)
                    ->with('tipos', Tipo::all())
                    ->with('materiais', $Materiais);

    }


    public function aloca() {
    $id = Request::route('id');

    $material = Material::find($id);
    $locais = Local::all();
    return view('material-alocacao')
            ->with('view', $this->view)
            ->with('locais', $locais)
            ->with('material', $material)
            ->with('status', 'nenhum');
  }


public function estocar(EstoqueRequest $request) {
    try {
        $this->view["active"] = "materiais";

        $estoque = new Estoque();
        $estoque->cod_material = $request->input('cod_material');
        $estoque->cod_local = $request->input('cod_local');
        $estoque->lote = $request->input('lote');
        $estoque->quantidade = $request->input('quantidade');
        $estoque->data_validade = $request->input('data_validade');
        $estoque->save();

        $estocado = Estoque::where('cod_material', $request->input('cod_material'))
                        ->where('cod_local', $request->input('cod_local'))
                        ->where('lote', $request->input('lote'))
                        ->first();

        $movimentacao = new Movimentacao();
        $movimentacao->estoque_id = $estocado->id;
        $movimentacao->cod_usuario = \Auth::user()->id;
        $movimentacao->qtde_movimentada = $request->input('quantidade');
        $movimentacao->tipo_movimentacao = 'Aquisição';
        $movimentacao->save();

        $material = Material::where('cod_material', $request->input('cod_material') );

        $material = Material::find($request->input('cod_material'));


        return redirect()
                ->action('MaterialController@consulta')
                ->with('status', 'alocado');

        } catch (\PDOException $e) {
            return redirect()
                ->action('MaterialController@aloca', ['id' => $request->input('cod_material') ])
                ->with('status', 'naoAlocado');
        }



    }




    public function consumoDiario(){
        $id = Request::route('id');
        $material = Material::find($id);
        return $material->calcConsumoDiario();
    }

}
