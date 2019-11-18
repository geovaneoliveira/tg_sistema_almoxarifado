<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    protected $table = 'Movimentacao';
    public $timestamps = true;
    protected $fillable = array('cod_material', 'qtde_movimentada', 'tipo_movimentacao','estoque_id', 'cod_usuario');
    protected $primaryKey = 'cod_movimentacao';

    const CREATED_AT = 'data_mov';
    const UPDATED_AT = null;
    

    public function estoque(){
		return $this->belongsTo('App\Estoque', 'estoque_id');
	}

	public function user(){
		return $this->belongsTo('App\User', 'cod_usuario');
	}

    public function requisicao(){
        return $this->belongsTo('App\Requisicao', 'cod_requisicao');
    }

    public static function listarMovimentacao($nome_material='', $lote='', $tipo_movimentacao='', $cod_local='', $data_mov='', $qtde_movimentada='', $cod_usuario='') {
        $stmt = DB::table('Movimentacao')
            ->join('Estoque', 'Movimentacao.estoque_id', '=', 'Estoque.id')
            ->join('Material', 'Estoque.cod_material', '=', 'Material.cod_material')
            ->join('Locais', 'Estoque.cod_local', '=', 'Locais.cod_local')
            ->join('Users', 'Movimentacao.cod_usuario', '=', 'Users.id')
            ->join('Requisicao', 'Movimentacao.cod_requisicao', '=', 'Requisicao.cod_requisicao');

        if ($nome_material) {
            $stmt->where('Estoque.nome_material', 'like', '%' . $nome_material . '%');
        }            

        if ($lote) {
            $stmt->where('Estoque.lote', 'like', '%' . $lote . '%');
        }

        if ($tipo_movimentacao) {
            $stmt->where('Movimentacao.tipo_movimentacao', $tipo_movimentacao);
        }

        if ($cod_local) {
            $stmt->where('Estoque.cod_local', $cod_local);
        }

        if ($data_mov) {
            $stmt->where('Movimentacao.data_mov', $data_mov);
        }

        if ($qtde_movimentada) {
            $stmt->where('Movimentacao.qtde_movimentada', $qtde_movimentada);
        }

        if ($cod_usuario) {
            $stmt->where('Users.id', $cod_usuario);
        }


        
        $listaEstocados = $stmt->select('Movimentacao.*', 'Material.nome_material', 'Locais.nome_local', 'Estoque.lote', 'Users.name')->get();
        
        return $listaEstocados;

    }
}

