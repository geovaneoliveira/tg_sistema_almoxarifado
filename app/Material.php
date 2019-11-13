<?php

namespace App;

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
		$consumoDiario = 0;
		$consumoTotal = 0;

		foreach ($this->estoques as $e)
		{
			foreach ($e->movimentacoes as $m)
			{
				if ($m->tipo_movimentacao == 'Requisição')
				{
					if (    /* fazer um if que só entra se a $m->data_mov estiver dentro de um periodo de no maximo 30 dias   */  1  )
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
/*
JEAN -> VOU FAZER A LÓGICA ASSIM:
NO FOR DAS MOVIMENTACOES, VÊ SE O DIA DELA JÁ TA NO ARRAY, SE NAO TIVER, ADICIONA NO ARRAY
VAI RODAR TODAS AS MOVIMENTACOES E IR BOTANDO TUDO NO ARRAY ( MAXIMO 30), NO FINAL VAI CONTAR QUANTOS DIAS DIFERENTES RODOU
DAI É SÓ DIVIDIR PELO NÚMERO DE MESES Q TIVER NESSE ARRAY
*/



		$dias = 1; /* fazer logica para  encontar o numero de dias entre hoje e a data $m->data_mov mais antiga*/
		$consumoDiario = $consumoTotal / $dias;
		return $consumoDiario;

	}







}

