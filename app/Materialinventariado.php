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


    public static function listarMateriais($cod_inventario='', $nome_material='', $lote='', $cod_tipo='', $cod_local='', $contagem='', $situacao='') {
        $stmt = DB::table('Materiais_inventariados')
            ->join('Estoque', 'Materiais_inventariados.id_estoque', '=', 'Estoque.id')
            ->join('Material', 'Estoque.cod_material', '=', 'Material.cod_material')
            ->join('Locais', 'Estoque.cod_local', '=', 'Locais.cod_local')
            ->join('tipo_material', 'Material.cod_tipo', '=', 'Tipo_material.cod_tipo');

            if ($cod_inventario) {
                $stmt->where('cod_inventario', '=', $cod_inventario);
            }
        if ($nome_material) {
            $stmt->where(\DB::Raw('UPPER(Material.nome_material)'), 'like', '%' . strtoupper($nome_material) . '%');
        }
        if ($lote) {
            $stmt->where(\DB::Raw('UPPER(Estoque.lote)'), 'like', '%' . strtoupper($lote) . '%');
        }
        if ($cod_tipo) {
            $stmt->where('Tipo_material.cod_tipo', '=', $cod_tipo);
        }
        if ($cod_local) {
            $stmt->where('Estoque.cod_local', '=', $cod_local);
        }

        if($contagem) {

        }

        if($situacao) {

        }

        $listaMateriais = $stmt->select('Materiais_inventariados.*', 'Material.nome_material', 'Locais.nome_local', 'Estoque.lote', 'Tipo_material.nome_tipo', 'Users.name')->get();

        $listaMateriais = $stmt->get();

        return $listaMateriais;

    }

}
