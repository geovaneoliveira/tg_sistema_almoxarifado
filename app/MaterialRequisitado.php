<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class MaterialRequisitado extends Model
{

	protected $table = 'requisicao_material';
	public $timestamps = false;
	protected $fillable = array('cod_requisicao', 'cod_material', 'quantidade_req');
	protected $primaryKey = 'id';

    public function requisicao() {
		return $this->belongsTo('App\Requisicao', 'cod_requisicao');
	}

	public function material() {
		return $this->belongsTo('App\Material', 'cod_material');
	}


	public static function listarMateriaisRequisitadosOnde($cod_requisicao = '') { 
		$stmt = DB::table('requisicao_material')
				->join('Material', 'requisicao_material.cod_material', '=', 'Material.cod_material')
				->join('tipo_material', 'Material.cod_tipo', '=', 'tipo_material.cod_tipo')
				->join('unidade_medida', 'Material.cod_unid_medida', '=', 'unidade_medida.cod_unid_medida');

		if ($cod_requisicao) {
			$stmt->where('requisicao_material.cod_requisicao', '=', $cod_requisicao);
		}

		$stmt->select('requisicao_material.*', 'Material.nome_material', 'tipo_material.nome_tipo', 'unidade_medida.descricao_unid_medida' );

		$materiaisRequisitados = $stmt->get();

        return $materiaisRequisitados;
	}


	public function calcQtdeAtend() {
		$qtdeAtend = 0;

		$requisicao = $this->requisicao;
		foreach ($requisicao->movimentacoes as $mo) {
			if($mo->estoque->cod_material == $this->cod_material){
				$qtdeAtend -= $mo->qtde_movimentada;
			}
			

	}

		//$qtdeAtend = $requisicao->cod_usuario;
		return $qtdeAtend;
	}

}
