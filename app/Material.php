<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use DB;
use App\Estoque;

class Material extends Model
{
    protected $table = 'Material';
    public $timestamps = false;
    protected $fillable = array('nome_material', 'cod_unid_medida', 'lead_time', 'cons_dia', 'cod_tipo', 'percentual_seg', 'margem_seg');
    protected $primaryKey = 'cod_material';

    public function tipo(){
		return $this->belongsTo('App\Tipo', 'cod_tipo');
	}

	public function unidade(){
		return $this->belongsTo('App\Unidade', 'cod_unid_medida');
	}

	public function estoques(){
		return $this->hasMany('App\Estoque', 'cod_material');
	}

	public function materiaisRequisitados() {
		return $this->hasMany('App\materiaisRequisitados', 'cod_material');
	}


	public function calcQtdeTotal(){
		$total=0;
		foreach ($this->estoques as $e) {
			$total += $e->quantidade;
		}
		return $total;
	}



	public static function listarMateriaisOnde($nome_material='', $cod_tipo='') {

		/*$listaMateriais = Material::where('nome_material', 'like', '%' . $nome_material . '%');
		if ($cod_tipo) {
			$listaMateriais = $listaMateriais->where('cod_tipo', $cod_tipo);
		}
		return $listaMateriais->get();*/

		$stmt = DB::table('Material')
						->join('tipo_material', 'Material.cod_tipo', '=', 'tipo_material.cod_tipo')
						->join('unidade_medida', 'Material.cod_unid_medida', '=', 'unidade_medida.cod_unid_medida')
                        ->join('estoque', 'Material.cod_material', '=', 'Estoque.cod_material');



        if ($nome_material) {
			$stmt->where('Material.nome_material', 'like', '%' . $nome_material . '%');
		}

		if ($cod_tipo) {
			$stmt->where('Material.cod_tipo', $cod_tipo);
		}

		$stmt->select('Material.cod_material', 'Material.nome_material', 'tipo_material.nome_tipo', 'unidade_medida.descricao_unid_medida', DB::raw('SUM(estoque.quantidade) as total') );

		$stmt->groupBy('Material.cod_material', 'Material.nome_material', 'tipo_material.nome_tipo', 'unidade_medida.descricao_unid_medida');

		$materiais = $stmt->get();

        return $materiais;

	}





	public function calcConsumoDiario()
	{
		$consumoDiario = 12;
        $consumoTotal = 0;
        $maiordata=Carbon::today()->addDays(-1)->toDateString();;

		foreach ($this->estoques as $e)
		{
			foreach ($e->movimentacoes as $m)
			{

				if ($m->tipo_movimentacao == 'Requisição')
				{

                    $hoje = Carbon::today()->toDateString();
                    $antes = Carbon::today()->addDays(-30)->toDateString();

                    if ($m->data_mov > $antes)
					{
                        if ($m->data_mov < $maiordata);
                        {
                            $maiordata = $m->data_mov;
                           }

						$consumoTotal -= $m->qtde_movimentada;
					}
				}
			}
		}

       $dias = Carbon::now()->diffInDays($maiordata, true);

if($dias > 0){
        $consumoDiario = $consumoTotal / $dias;
		return $consumoDiario;
}
if($dias <= 0){
return $consumoTotal;

}
    //  return rand(0, 12);
	}







}

