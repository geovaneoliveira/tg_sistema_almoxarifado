<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'Movimentacao';
    public $timestamps = true;
    protected $fillable = array('cod_material', 'qtde_movimentada', 'tipo_movimentacao','estoque_id', 'cod_usuario');
    protected $primaryKey = 'cod_movimentacao';

    const CREATED_AT = 'data_mov';
    const UPDATED_AT = null;

     public function estoque(){
		return $this->belongsTo('App\Estoque', 'estoque_id');
	}

	public function user(){
		return $this->belongsTo('App\User', 'cod_usuario');
	}

//	public function requisicao(){
//		return $this->belongsTo('App\Requisicao', 'cod_requisicao');
//	}
}

