<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materialinventariado extends Model
{
	protected $table = 'materiais_inventariados';
	public $timestamps = false;
	protected $fillable = array('cod_inventario', 'id_estoque', 'qtde_estoque_sistema', 'qtde_estoque_real');
	protected $primaryKey = 'id';

	public function contagens(){
		return $this->hasMany('App\Contagem', 'id_matinventariados');
    }

    public function inventario() {
		return $this->belongsTo('App\Inventario', 'cod_inventario');
	}

	public function estoque() {
		return $this->belongsTo('App\Estoque', 'id_estoque');
	}




}
