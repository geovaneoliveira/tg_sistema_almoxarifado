@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')



<form action="/movimentacoes/localiza" class="ml-4 mr-4" method="post"> <!-- início do formulario -->


  <div class="form">

    <div class="d-flex flex-wrap " style="width: 100%;">

<div class="form-row d-flex align-items-end" style="width: 100%;">
  <div class="form-group col-sm-7 col-md-8">
              <label for="nome_material">Nome do Material:</label>
              <input type="text" class="form-control" id="nome_material" name="nome_material">

          <label for="lote">Lote:</label>
          <input type="text" class="form-control" id="lote" name="lote">

      </div>

      <div class="col-sm-5 col-md-4 form-group" style="width: 100%;">
            <fieldset class="border p-2">
              <legend class=" m-0 p-0" style="font-size: 1em;">Tipo Movimentação</legend>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Aquisição" id="tipo_movimentacao" name="tipo_movimentacao[]">
                  <label class="form-check-label" for="tipo_movimentacao">
                    Aquisição
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Requisição" id="tipo_movimentacao" name="tipo_movimentacao[]">
                  <label class="form-check-label" for="tipo_movimentacao">
                    Requisição
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Ajuste" id="tipo_movimentacao" name="tipo_movimentacao[]">
                  <label class="form-check-label" for="tipo_movimentacao">
                    Ajuste
                  </label>
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="Inventário" id="tipo_movimentacao" name="tipo_movimentacao[]">
                  <label class="form-check-label" for="tipo_movimentacao">
                    Inventário
                  </label>
                </div>

            </fieldset>
          </div>

</div>

      <div class="form-row d-flex align-items-end" style="width: 100%;">

        <div class="form-group col col-md-6">
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

      <div class="form-group col col-md-6">
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

        <div class="col-sm-12 col-md-6 form-group">
            <label for="data_mov"> Período </label>
            <div class="input-group">
              <input type="date" class="form-control" id="data_mov" name="data_mov">
              <input type="date" class="form-control" id="data_mov" name="data_mov">
            </div>
        </div>

                <div class="col-sm-12 col-md-6 form-group">
            <label for="name"> Responsável </label>
            <div class="input-group">
              <input type="text" class="form-control" name="name" id="name" placeholder="parte do nome do Responsável">
            </div>
        </div>

      </div>


      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

  </div> <!--fim da primeira linha-->


    <div class="row" style="max-height: 300px; overflow-y: auto;" ><!--inicio da listagem de movimentacoes-->
      <div class="col">
        <table class="table table-sm table-bordered table-hover ">
        <tr>
          <th>Material</th>
          <th>Local</th>
          <th>Lote</th>
          <th>Data/Hora</th>
          <th>Tipo</th>
          <th>Qtde</th>
          <th>Responsável</th>
          <th>Requ.</th>
        </tr>
        @foreach ($movimentados as $m)
        <tr>
            <td                            > {{$m->nome_material}} </td>
            <td                            > {{$m->nome_local }} </td>
            <td                            > {{$m->lote }} </td>
            <td                            > {{$m->data_mov }} </td>
            <td                            > {{$m->tipo_movimentacao}} </td>
            <td                            > {{$m->qtde_movimentada }} </td>
            <td                            > {{$m->name }} </td>
            <td                            > {{$m->cod_requisicao }} </td>
        </tr>
        @endforeach
       </table>

      </div>
    </div><!--fim da listagem de locais-->

  <div class="row">
    <div class="col d-flex justify-content-around mt-2" id="secao-botoes">
        <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-search"></i>Localizar</button>
        <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>
    </div>
  </div>

</form> <!-- fim do formulário-->


@endsection
