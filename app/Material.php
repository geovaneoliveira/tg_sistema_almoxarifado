<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'Material';
    public $timestamps = false;
    protected $fillable = array('nome_material', 'cod_unid_medida', 'estoque_min', 'lead_time', 'cons_dia', 'cod_tipo');
    protected $primaryKey = 'cod_material';

    public function tipo(){
		return $this->belongsTo('App\Tipo', 'cod_tipo');
	}

	public function unidade(){
		return $this->belongsTo('App\Unidade', 'cod_unid_medida');
	}

	public function estoques(){
		return $this->hasMany('App\Estoque', 'cod_material');
	}


	public function calcQtdeTotal(){
		$total=0;
		foreach ($this->estoques as $e) {
			$total += $e->quantidade;
		}
		return $total;
	}



	public function calcConsumoTotal(){
		$consumoDiario = 0;

		foreach ($this->estoques as $e) {

			foreach ($e->movimentacoes as $m) {
				if ($m->tipo_movimentacao == 'Requisição'){
					$consumoDiario += $m->qtde_movimentada;
				}				
			}
		}

		return $consumoDiario;
	}




	


}

