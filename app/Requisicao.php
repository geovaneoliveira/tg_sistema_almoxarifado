<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Requisicao extends Model
{
	protected $table = 'requisicao';
	public $timestamps = true;
	protected $fillable = array('cod_usuario', 'data_atend', 'situacao');
	protected $primaryKey = 'cod_requisicao';
 	//protected $dateFormat = 'Y/m/j H:i:s';
	const CREATED_AT = 'data_req';
    const UPDATED_AT = null;

    public function user() {
		return $this->belongsTo('App\User', 'cod_usuario');
	}

	public function movimentacoes() {
		return $this->hasMany('App\Movimentacao', 'cod_requisicao');
	}

	public function materiais_requisitados() {
		return $this->hasMany('App\MaterialRequisitado', 'cod_requisicao');
	}

	public function get_data_req_formatada() {
		if($this->data_req != null){
			return date('d/m/Y', strtotime($this->data_req));
		}else{
			return "";
		}
	}

	public function get_data_atend_formatada() {
		if($this->data_atend != null){
			return date('d/m/Y', strtotime($this->data_atend));
		}else{
			return "";
		}
	}
}
