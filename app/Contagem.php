<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contagem extends Model
{
	protected $table = 'contagem';
	public $timestamps = false;
	protected $fillable = array('id_matinventariados', 'id_contador', 'qtde_contada');
	protected $primaryKey = 'id';

    public function materialinventariado() {
		return $this->belongsTo('App\Materialinventariado', 'id_matinventariados');
    }

    public function user() {
		return $this->belongsTo('App\User', 'id_contador');
	}
}
