@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="" action="/adm-inventarios/finalizar">

    <fieldset class="border shadow-sm p-3">
    <legend>Inconsistências:</legend>

    <div class="form-row d-flex align-items-end">


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

          <div class="col-sm-6 col-md-4  form-group">
            <label for="contagem">Contagem</label>
            <div class="input-group">
              <select class="form-control" id="contagem" name="contagem">
                <option value=""> Não inventariados</option>
                <option value=""> Inventáriados </option>
                <option value=""> Todos </option>
              </select>
            </div>
          </div>

          <div class="col-sm-6 col-md-4 form-group ">
            <fieldset class="border p-2">
              <legend class=" m-0 p-0" style="font-size: 1em;">Situação</legend>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="">
                <label class="form-check-label" for="defaultCheck1">
                Avaliados
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                Não Avaliados
              </div>

            </fieldset>
          </div>

          <div class="col-sm-6 col-md-4 form-group">
            <label for="">Material</label>
            <input type="text" class="form-control" id="" placeholder="parte do nome do material">
          </div>

          <div class="col-sm-6 col-md-4 form-group">
            <label for="">Lote</label>
            <input type="text" class="form-control" id="" placeholder="parte núm. lote">
          </div>


          <div class="form-group col-sm-6 col-md-4 " >
                  <button type="submit" class="btn btn-success" style="width: 100%;"><i class="fas fa-search mr-2"></i>Localizar</button>
          </div>





      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


    <div class="form-row">
      <div class="col-md-12" style="max-height:400px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr>
            <th>Est.</th>
            <th>Material </th>
            <th>Lote </th>
            <th>Local</th>
            <th>Qtde </th>
            <th>Unid </th>
            <th>Contador </th>
            <th>Qtde </th>
            <th > <i class="fas fa-check-double " > </th>
          </tr>

          @foreach ($estocados as $e)
          <tr>
            <td                            > {{$e->id}} </td>
            <td                            > {{$e->nome_material}} </td>
            <td                            > {{$e->lote }} </td>
            <td                            > {{$e->nome_local }} </td>
            <td                            > {{$e->quantidade }} </td>
            <td                            > {{$e->descricao_unid_medida }} </td>
            <td                            > Coordenador da Silva </td>
            <td                            > {{$e->quantidade - 5}} </td>
            <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
              </tr>
          @endforeach







        </table>
      </div><!--fim da listagem de locais-->
    </div>


</fieldset>
<div class="row mt-4">
        <div class="col-12 d-flex justify-content-around" id="">
          <button type="button" class="btn btn-lg btn-warning col col-md-6" onclick="window.location.href='/adm-inventarios/finalizar';"><i class="fas fa-check-double  mr-2" > </i>Finalizar Inventário</button>
        </div>
      </div>
</form> <!-- fim do formulário-->










</div>


@endsection
