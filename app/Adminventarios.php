<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adminventarios extends Model
{
	protected $table = 'inventario';
	public $timestamps = false;
	protected $fillable = array('cod_resp', 'data_inicio', 'data_fim');
	protected $primaryKey = 'cod_inventario';


}
