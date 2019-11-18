<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
	protected $table = 'locais';
	public $timestamps = false;
	protected $fillable = array('nome_local');
	protected $primaryKey = 'cod_local';

	public function estoques(){
		return $this->hasMany('App\Estoque', 'cod_local');
	}

}
