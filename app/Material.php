<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'Material';
    public $timestamps = false;
    protected $fillable = array('nome_material', 'cod_unid_medida', 'estoque_min', 'lead_time', 'cons_dia', 'cod_tipo');
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


	public function calcQtdeTotal(){
		$total=0;
		foreach ($this->estoques as $e) {
			$total += $e->quantidade;
		}
		return $total;
	}



	public function calcConsumoDiario()
	{
		$consumoDiario = 12;
        $consumoTotal = 0;
        $maiordata=Carbon::today()->addDays(-180)->toDateString();;

		foreach ($this->estoques as $e)
		{
			foreach ($e->movimentacoes as $m)
			{
				if ($m->tipo_movimentacao == 'Requisição')
				{
                    $hoje = Carbon::today()->toDateString();
                    $antes = Carbon::today()->addDays(-30)->toDateString();

                    if ($m->data_mov > $maiordata){
                     $maiordata = $m->data_mov;
                    }


					if ($m->data_mov > $antes)
					{
						$consumoTotal -= $m->qtde_movimentada; //observação, estou subtraindo pq na tabela de movimentações, as requisições são negativas!
						if (1)
						{
							/* fazer lógica para pegar a $m->data_mov mais dentro do periodo de 90 dias).
							isso visa garantir que a média não vai ficar estranha se o produto for cadastrado ontem por exemplo
							*/
						}
					}
				}
			}
		}

        $dias = $hoje - $maiordata;


	//	$dias = 1; /* fazer logica para  encontar o numero de dias entre hoje e a data $m->data_mov mais antiga*/
		$consumoDiario = $consumoTotal / $dias;
		return $consumoDiario;
	}







}

