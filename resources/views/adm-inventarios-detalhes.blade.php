@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="" action="/adm-inventarios/exibeDetalhes/localizar">

    <div class="form-row d-flex align-items-end">

       <div class="col-sm-12 col-md-3 form-group">
          <label for="cod_inventario">Cód.</label>
       <input type="text" class="form-control" id="cod_inventario" name="cod_inventario" value="{{$inventario->cod_inventario}}" readonly />
        </div>

        <div class="col-sm-12 col-md-6 form-group">
          <label for="cod_resp">Responsável</label>
        <input type="text" class="form-control" id="cod_resp" name="cod_resp" value="{{$inventario->user->name}}" readonly />
        </div>

        <div class="col-sm-12 col-md-3 form-group">
            <label for="data_inicio"> Data de Início</label>
            <div class="input-group">
            <input type="text" class="form-control" id="data_inicio" name="data_inicio" value="{{$inventario->data_inicio}}" readonly />
            </div>
        </div>

        <div class="form-group col-6 col-md-3">
            <label for="cod_local">Local:</label>
            <div class="input-group" >
              <select class="form-control" id="cod_local" name="cod_local">
                <option value="">todos</option>
                @foreach($locais as $l)
                <option value="{{$l->cod_local}}">{{$l->nome_local}}</option>
                @endforeach
              </select>
            </div>
          </div>


          <div class="form-group col-6 col-md-3">
            <label for="cod_tipo">Tipo de Material:</label>
            <div class="input-group" >
              <select class="form-control" id="cod_tipo" name="cod_tipo">
                <option value="">todos</option>
                @foreach($tipos as $t)
                <option value="{{$t->cod_tipo}}">{{$t->nome_tipo}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 form-group">
            <label for="cod_material">Material</label>
            <input type="text" class="form-control" id="cod_material" name="cod_material" placeholder="parte do nome do material">
          </div>

          <div class="col-sm-6 col-md-3 form-group">
            <label for="lote">Lote</label>
            <input type="text" class="form-control" id="lote" name="lote" placeholder="parte núm. lote">
          </div>

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

    <div class="form-row">
      <div class="col-md-12" style="max-height:400px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr >
            <th class="thmaster bg-success" colspan="5" >Estoque</th>
            <th class="thmaster bg-success" colspan="3" >Inventariado</th>
          </tr>
          <tr>
            <th>Material </th>
            <th>Lote </th>
            <th>Local</th>
            <th>Qtde</th>
            <th>Unid </th>
            <th>Contador</th>
            <th>Qtde</th>
            <th > <i class="fas fa-check-double " > </th>
          </tr>

          @foreach($materiaisinventariados as $i)
          <tr>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->material->nome_material}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->lote}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->local->nome_local}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->quantidade}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->material->unidade->descricao_unid_medida}} </td>
          </tr>
            @foreach($i->contagens as $co)
              <tr>
                  <td> {{$co->user->name}} </td>
                  <td> {{$co->qtde_contada}} </td>
                  <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td> 
              </tr>
            @endforeach
          @endforeach


        </table>
      </div><!--fim da listagem de locais-->
    </div>

    <div class="row mt-4">
        <div class="col-12 d-flex justify-content-around" id="">

          <button type="submit" class="btn btn-lg col-md-4 btn-success" style="width: 100%;"><i class="fas fa-search mr-2"></i>Localizar</button>
          <button type="button" class="btn btn-lg col-md-4 btn-success" onclick="history.back()" style="width: 100%;"> <i class="fas fa-ban mr-2"></i>Voltar</button>
        </div>
      </div>
</form> <!-- fim do formulário-->










</div>


@endsection
