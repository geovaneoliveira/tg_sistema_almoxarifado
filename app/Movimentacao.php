<?php

namespace App;
use DB;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'Movimentacao';
    public $timestamps = true;
    protected $fillable = array('qtde_movimentada', 'tipo_movimentacao','estoque_id', 'cod_usuario', 'cod_requisicao');
    protected $primaryKey = 'cod_movimentacao';

    const CREATED_AT = 'data_mov';
    const UPDATED_AT = null;

    public function setDateAttribute( $value ) {
        $this->attributes['data_mov'] = (new Carbon($value))->format('d/m/y');
      }


    public function estoque(){
		return $this->belongsTo('App\Estoque', 'estoque_id');
	}

	public function user(){
		return $this->belongsTo('App\User', 'cod_usuario');
	}

    public function requisicao(){
        return $this->belongsTo('App\Requisicao', 'cod_requisicao');
    }


    public static function listarMovimentacao($nome_material='', $lote='', $tipo_movimentacao='', $cod_local='', $data_mov_ini='', $data_mov_fim='', $qtde_movimentada='', $cod_usuario='') {
        $stmt = DB::table('Movimentacao')
            ->join('Estoque', 'Movimentacao.estoque_id', '=', 'Estoque.id')
            ->join('Material', 'Estoque.cod_material', '=', 'Material.cod_material')
            ->join('Locais', 'Estoque.cod_local', '=', 'Locais.cod_local')
            ->join('Users', 'Movimentacao.cod_usuario', '=', 'Users.id')
            ->leftJoin('Requisicao', 'Movimentacao.cod_requisicao', '=', 'Requisicao.cod_requisicao');

        if ($nome_material) {
            $stmt->where('Material.nome_material', 'like', '%' . $nome_material . '%');
        }

        if ($lote) {
            $stmt->where('Estoque.lote', 'like', '%' . $lote . '%');
        }

        if ($tipo_movimentacao) {
            $stmt->wherein('Movimentacao.tipo_movimentacao', $tipo_movimentacao);
        }

        if ($cod_local) {
            $stmt->where('Estoque.cod_local', $cod_local);
        }

        if ($data_mov_ini) {
            $stmt->whereDate('Movimentacao.data_mov', '>=', $data_mov_ini);
        }

        if ($data_mov_fim) {
            $stmt->whereDate('Movimentacao.data_mov', '<=', $data_mov_fim);
        }


        if ($qtde_movimentada) {
            $stmt->where('Movimentacao.qtde_movimentada', $qtde_movimentada);
        }

        if ($cod_usuario) {
            $stmt->where('Users.name', 'like', '%' . $cod_usuario . '%');
        }


        $listaEstocados = $stmt->select('Movimentacao.*', 'Material.nome_material', 'Locais.nome_local', 'Estoque.lote', 'Users.name')->get();

        $listaEstocados = $stmt->get();

        foreach ($listaEstocados as $LE)
        {
            $dt = Carbon::create($LE->data_mov);

             $LE->data_mov = $dt;

             $LE->data_mov = date_format($LE->data_mov,"d/m/Y");

        }

        return $listaEstocados;

    }


}

