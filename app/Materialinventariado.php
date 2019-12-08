<?php

namespace App;
use DB;

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


    public static function listarMateriais($nome_material='', $lote='', $cod_tipo='', $local='', $contagem='', $situacao='') {
        $stmt = DB::table('materiais_inventariados')
            ->join('Estoque', 'materiais_inventariados.id_estoque', '=', 'Estoque.id')
            ->join('Material', 'Estoque.cod_material', '=', 'Material.cod_material')
            ->join('Locais', 'Estoque.cod_local', '=', 'Locais.cod_local')
            ->join('tipo_material', 'Material.cod_tipo', '=', 'tipo_material.cod_tipo');

        if ($nome_material) {
            $stmt->where(\DB::Raw('UPPER(Material.nome_material)'), 'like', '%' . strtoupper($nome_material) . '%');
        }

        if ($lote) {
            $stmt->where(\DB::Raw('UPPER(Estoque.lote)'), 'like', '%' . strtoupper($lote) . '%');
        }

        if ($local) {
            $stmt->where('Estoque.cod_local', $local);
        }

        if ($cod_tipo) {
            $stmt->where('tipo_material.cod_tipo', $cod_tipo);
        }

        if($contagem) {

        }

        if($situacao) {

        }


        $listaMateriais = $stmt->select('materiais_inventariados.*', 'Material.nome_material', 'Locais.nome_local', 'Estoque.lote', 'tipo_material.nome_tipo', 'Users.name')->get();

     //   $listaMateriais = $stmt->get();


        return $listaMateriais;

    }

}
