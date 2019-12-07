@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form action="/inventario/localiza" class="" method="get">

    <div class="form-row d-flex align-items-end">

@if(empty($inventario))

<div class="col-sm-12 col-md-2 form-group">
        <label for="cod_inventario">Inventário Ativo</label>
        <input type="text" class="form-control" id="cod_inventario" name="cod_inventario" value="" readonly />
      </div>

      <div class="col-sm-12 col-md-5 form-group">
        <label for="cod_resp">Responsável</label>
        <input type="text" class="form-control" id="cod_resp" name="cod_resp" value="" readonly />
      </div>

      <div class="col-sm-12 col-md-5 form-group">
        <label for="user">Contador</label>
        <input type="text" class="form-control" id="user" name="user" value="" readonly />
      </div>





@else
@foreach($inventario as $i)
@if($loop->first)
       <div class="col-sm-12 col-md-2 form-group">
          <label for="cod_inventario">Inventário Ativo</label>
          <input type="text" class="form-control" id="cod_inventario" name="cod_inventario" value="{{ $i->cod_inventario }}" readonly />
        </div>

        <div class="col-sm-12 col-md-5 form-group">
          <label for="cod_resp">Responsável</label>
          <input type="text" class="form-control" id="cod_resp" name="cod_resp" value="{{ $i->user->name }}" readonly />
        </div>

        <div class="col-sm-12 col-md-5 form-group">
          <label for="user">Contador</label>
          <input type="text" class="form-control" id="user" name="user" value="{{Auth::user()->name}}" readonly />
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
            <td                            > {{$e->descricao_unid_medida }}</td>
            <td                            > CODIGO INVENTARIO {{$i->cod_inventario}}</td>
            <td                            > CODIGO MAT {{$e->id}}</td>
            <td > <input type="text" name="qtde_contada" id="qtde_contada" value="" placeholder="digite qtde..." class="p-0 m-0" style="width: 100%;" />  </td>
            <td onclick="btn_inventario({{$loop->index}}, {{$e->id }}, {{$i->cod_inventario}});"> <a id="{{$loop->index}}"> <span  class="fas fa-arrow-right text-success">   </span> </a> </td>
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
      @endif
      @endforeach
      @endif
    </div>

</form> <!-- fim do formulário-->

</div>


@push('scripts')

<script>
    function btn_inventario(e, a, codinv) {

      document.getElementById(e).innerHTML = '<i class="fas fa-pencil-alt" </i>';

  var qtde_contada = document.getElementById('qtde_contada').value;


  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      //document.getElementById("cons_dia_id").value = this.responseText;

    }
  };
  xhttp.open("GET", "/adm-inventarios/contagem/" + a + "/" + qtde_contada + "/" + codinv , true);
  xhttp.send();
}

</script>
@endpush



@endsection
