<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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

}
