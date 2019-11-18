<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
	protected $table = 'tipo_material';
	public $timestamps = false;
	protected $fillable = array('nome_tipo');
	protected $primaryKey = 'cod_tipo';

	public function materiais(){
		return $this->hasMany('App\Material', 'cod_tipo');
	}
}
