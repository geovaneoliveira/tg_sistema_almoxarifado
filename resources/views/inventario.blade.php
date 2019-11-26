@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form action="/inventario/localiza" class="" method="get">

    <div class="form-row d-flex align-items-end">

       <div class="col-sm-12 col-md-2 form-group">
          <label for="">Inventário Ativo</label>
          <input type="text" class="form-control" id="" value="" readonly />
        </div>

        <div class="col-sm-12 col-md-5 form-group">
          <label for="">Responsável</label>
          <input type="text" class="form-control" id="" value="" readonly />
        </div>

        <div class="col-sm-12 col-md-5 form-group">
          <label for="">Contador</label>
          <input type="text" class="form-control" id="" value="" readonly />
        </div>

          <div class="col-sm-6 col-md-3  form-group">
            <label for="cod_tipo">Local</label>
            <div class="input-group">
              <select class="form-control" id="cod_local" name="cod_local">
                <option value=""> Todos </option>
            @foreach($locais as $l)
            <option value="{{$l->cod_local}}">{{$l->nome_local}}</option>
            @endforeach
              </select>
            </div>
          </div>


          <div class="col-sm-6 col-md-3 form-group">
            <label for="cod_tipo">Tipo</label>
            <div class="input-group">
              <select class="form-control" id="cod_tipo" name="cod_tipo">
                <option value=""> Todas </option>
                @foreach($tipos as $c)
                <option value="{{$c->cod_tipo}}">{{$c->nome_tipo}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-sm-6 col-md-3 form-group">
            <label for="nome_material">Material</label>
            <input type="text" class="form-control" id="nome_material" name="nome_material" placeholder="parte do nome do material">
          </div>

          <div class="col-sm-6 col-md-3 form-group">
            <label for="lote">Lote</label>
            <input type="text" class="form-control" id="lote" name ="lote" placeholder="parte núm. lote">
          </div>

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


    <div class="form-row">
      <div class="col-md-12" style="max-height:300px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr >
            <th class="thmaster bg-success" colspan="5" >Estoque</th>
            <th class="thmaster bg-success" colspan="2" >Inventariado</th>
          </tr>
          <tr>
            <th>Material </th>
            <th>Lote </th>
            <th>Local</th>
            <th>Qtde</th>
            <th>Unid </th>
            <th style="width: 12%;">Qtde</th>
            <th> </th>
          </tr>
          @foreach ($estocados as $e)
          <tr>
            <td                            > {{$e->nome_material}} </td>
            <td                            > {{$e->lote }} </td>
            <td                            > {{$e->nome_local }} </td>
            <td                            > {{$e->quantidade }} </td>
            <td                            > {{$e->descricao_unid_medida }} </td>
            <td > <input type="text" name="" value="" placeholder="digite qtde..." class="p-0 m-0" style="width: 100%;" />  </td>
            <td> <a href="/home"> <span class="fas fa-arrow-right text-success">   </span> </a> </td>
        </tr>
          @endforeach

        </table>
      </div><!--fim da listagem de locais-->
    </div>









    <div class="row mt-4">
      <div class="col-12 d-flex justify-content-around" id="">

        <button type="submit" class="btn btn-lg col-md-4 btn-success" onclick=""style="width: 100%;"><i class="fas fa-search mr-2"></i>Localizar</button>
        <button type="button" class="btn btn-lg col-md-4 btn-success" onclick="history.back()" style="width: 100%;"> <i class="fas fa-ban mr-2"></i>Voltar</button>
      </div>
    </div>

</form> <!-- fim do formulário-->

</div>


@endsection
