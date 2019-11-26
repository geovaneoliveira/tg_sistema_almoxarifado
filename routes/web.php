<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/local', 'LocalController@lista');
Route::post('/local/adiciona', 'LocalController@adiciona');
Route::get('/local/remove/{id}', 'LocalController@remove');
Route::get('/local/edita/{id}', 'LocalController@edita');
Route::post('/local/atualiza', 'LocalController@atualiza');

Route::get('/unidade', 'UnidadeController@lista');
Route::post('/unidade/adiciona', 'UnidadeController@adiciona');
Route::get('/unidade/remove/{id}', 'UnidadeController@remove');
Route::get('/unidade/edita/{id}', 'UnidadeController@edita');
Route::post('/unidade/atualiza', 'UnidadeController@atualiza');

Route::get('/tipo', 'TipoController@lista');
Route::post('/tipo/adiciona', 'TipoController@adiciona');
Route::get('/tipo/remove/{id}', 'TipoController@remove');
Route::get('/tipo/edita/{id}', 'TipoController@edita');
Route::post('/tipo/atualiza', 'TipoController@atualiza');

Route::get('/material', 'MaterialController@novo');
Route::post('/material/adiciona', 'MaterialController@adiciona');
Route::get('/material/consulta', 'MaterialController@consulta');
Route::get('/material/edita/{id}', 'MaterialController@edita');
Route::get('/material/consulta/remove/{id}', 'MaterialController@remove');
Route::post('/material/atualiza', 'MaterialController@atualiza');
Route::post('/material/localiza', 'MaterialController@localiza');
Route::get('/material/aloca/{id}', 'MaterialController@aloca');
Route::post('/material/estocar', 'MaterialController@estocar');

Route::get('/material/consumodiario/{id}', 'MaterialController@consumoDiario');

Route::get('/user/gerenciar', 'UserController@gerenciar');
Route::post('/user/localiza', 'UserController@localiza');
Route::post('/user/adiciona', 'UserController@adiciona');
Route::get('/user/remove/{id}', 'UserController@remove');
Route::get('/user/edita/{id}', 'UserController@edita');
Route::get('/user/reseta/{id}', 'UserController@reseta');
Route::post('/user/atualiza', 'UserController@atualiza');
Route::get('/user/minhaconta', 'UserController@minhaconta');
Route::post('/user/atualizabyuser', 'UserController@atualizabyuser');

Route::get('/estoque/form', 'EstoqueController@form');
Route::get('/estoque/gerenciar', 'EstoqueController@gerenciar');
Route::post('/estoque/localiza', 'EstoqueController@localiza');
Route::post('/estoque/atualiza', 'EstoqueController@atualiza');
Route::get('/estoque/ajusta/{id}', 'EstoqueController@ajusta');
Route::get('/estoque/edita/{id}', 'EstoqueController@edita');
Route::get('/estoque/remove/{id}', 'EstoqueController@remove');

Route::get('/requisicao', 'RequisicaoController@abreForm');
Route::get('/requisicao/localizaEstocados/{json}', 'RequisicaoController@localizaEstocados');
Route::get('/requisicao/requisita/{cod_requisicao}/{jsonMateriais}', 'RequisicaoController@requisita');

Route::get('/minhas-requisicoes', 'MinhasRequisicoesController@abreForm');
Route::get('/minhas-requisicoes/edita/{cod_requisicao}', 'MinhasRequisicoesController@edita');
Route::get('/minhas-requisicoes/remove/{cod_requisicao}', 'MinhasRequisicoesController@remove');
Route::get('/minhas-requisicoes/exibeDetalhes/{cod_requisicao}', 'MinhasRequisicoesController@exibeDetalhes');
Route::post('/minhas-requisicoes/localiza', 'MinhasRequisicoesController@localiza');
Route::get('/minhas-requisicoes/localizaMateriaisRequisitados/{cod_requisicao}', 'MinhasRequisicoesController@localizaMateriaisRequisitados');

Route::get('/saida', 'SaidaController@abreForm');
Route::post('/saida/localiza', 'SaidaController@localiza');
Route::get('/saida/exibeDetalhes/{cod_requisicao}', 'SaidaController@exibeDetalhes');
Route::get('/saida/nega/{cod_requisicao}', 'SaidaController@nega');
Route::get('/saida/atende/{cod_requisicao}', 'SaidaController@atende');
Route::get('/saida/localizaMateriaisRequisitadosComEstoques/{cod_requisicao}', 'SaidaController@localizaMateriaisRequisitadosComEstoques');
Route::post('/saida/finaliza', 'SaidaController@finaliza');


Route::get('/adm-inventarios', 'AdmInventariosController@abreForm');
Route::get('/adm-inventarios/analisa', 'AdmInventariosController@abreFormAnalisa');
Route::get('/adm-inventarios/localiza', 'AdmInventariosController@abreFormLocaliza');
Route::get('/adm-inventarios/exibeDetalhes/{id}', 'AdmInventariosController@exibeDetalhes');

Route::get('/inventario', 'InventarioController@abreForm');
Route::get('/inventario/localiza', 'InventarioController@localizaMateriais');

Route::get('/movimentacoes', 'MovimentacoesController@abreForm');
Route::post ('/movimentacoes/localiza', 'MovimentacoesController@localiza');
