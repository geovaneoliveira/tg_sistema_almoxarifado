<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materiaisinventariados extends Model
{
	protected $table = 'materiais_inventariados';
	public $timestamps = false;
	protected $fillable = array('cod_inventario', 'id_estoque', 'qtde_estoque_sistema', 'qtde_estoque_real');
	protected $primaryKey = 'id';


}
