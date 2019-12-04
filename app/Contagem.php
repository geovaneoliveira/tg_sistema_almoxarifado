<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contagem extends Model
{
	protected $table = 'contagem';
	public $timestamps = false;
	protected $fillable = array('id_matinventariados', 'id_contador', 'qtde_contada');
	protected $primaryKey = 'id';


}
