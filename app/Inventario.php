<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
	protected $table = 'inventario';
	public $timestamps = false;
	protected $fillable = array('cod_resp', 'data_inicio', 'data_fim');
	protected $primaryKey = 'cod_inventario';

	public function materiaisinventariados(){
		return $this->hasMany('App\Materialinventariado');
    }

    public function user() {
		return $this->belongsTo('App\User', 'cod_resp');
	}
}
