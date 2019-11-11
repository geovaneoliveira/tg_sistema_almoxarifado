<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidade extends Model
{
	protected $table = 'unidade_medida';
	public $timestamps = false;
	protected $fillable = array('descricao_unid_medida');
	protected $primaryKey = 'cod_unid_medida';

	public function materiais(){
		$this->hasMany('App\Material');
	}
}
