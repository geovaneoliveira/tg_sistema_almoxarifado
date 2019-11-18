<?php

namespace App;

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

	public function materiaisRequisitados() {
		return $this->hasMany('App\materiaisRequisitados', 'cod_requisicao');
	}

}
