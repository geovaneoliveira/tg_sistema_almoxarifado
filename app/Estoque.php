<?php

namespace App;
use App\Material;
use DB;
use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $table = 'Estoque';
    public $timestamps = false;
    protected $fillable = array('cod_material', 'cod_local', 'lote', 'quantidade','data_validade');
    protected $primaryKey = 'id';

     public function local(){
		return $this->belongsTo('App\Local', 'cod_local');
	}

	public function material(){
		return $this->belongsTo('App\Material', 'cod_material' );
	}

	public function movimentacoes(){
		return $this->hasMany('App\Movimentacao',  'cod_material' );
	}



	public static function listarEstocadosOnde($nome_material='', $cod_tipo='', $lote='', $cod_local='') {
		$stmt = DB::table('Estoque')
            ->join('Material', 'Estoque.cod_material', '=', 'Material.cod_material')
            ->join('Locais', 'Estoque.cod_local', '=', 'Locais.cod_local');

        if ($nome_material) {
			$stmt->where('Material.nome_material', 'like', '%' . $nome_material . '%');
		}            

        if ($lote) {
			$stmt->where('Estoque.lote', 'like', '%' . $lote . '%');
		}

		if ($cod_tipo) {
			$stmt->where('Material.cod_tipo', $cod_tipo);
		}

		if ($cod_local) {
			$stmt->where('Estoque.cod_local', $cod_local);
		}
		
		$listaEstocados = $stmt->select('Estoque.*', 'Material.nome_material', 'Locais.nome_local')->get();
		
        return $listaEstocados;

	}


	public function get_data_atend_formatada() { //usa no formulario de saida de material, linhas de tabele e inputs text
		if($this->data_validade != null){
			return date('d/m/Y', strtotime($this->data_validade));
		}else{
			return "";
		}		
	}



	public function getDataValidadeForm(){ //usa no formulario de estoque, input date
		if($this->data_validade != null){
			return date('Y-m-d', strtotime($this->data_validade));
		}else{
			return "";
		}
		
	}

}

