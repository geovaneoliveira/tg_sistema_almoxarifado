@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<form action="/estoque/localiza" class="ml-4 mr-4" method="post"> <!-- início do formulario -->


  <div class="row">  

    <div class="d-flex flex-wrap ">

      <div class="form-group col-md-6">
              <label for="nome_material">Nome do Material:</label>
              <input type="text" class="form-control" id="nome_material" name="nome_material">
          
      </div>


      <div class="form-group col-md-6">
        <label for="cod_tipo">Tipo de Material:</label>
        <div class="input-group" >
          <select class="form-control" id="cod_tipo" name="cod_tipo">
            <option value="">todos</option>
            @foreach($tipos as $c)
            <option value="{{$c->cod_tipo}}">{{$c->nome_tipo}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group col-md-6">
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

      <div class="form-group col-md-6">
          <label for="lote">Lote:</label>
          <input type="text" class="form-control" id="lote" name="lote">
      </div>

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

  </div> <!--fim da primeira linha-->


    <div class="row" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de locais-->
      <div class="col">
        <table class="table table-sm table-bordered table-hover ">
        <tr>
          <th>Material</th>
          <th>Local</th>
          <th>Lote</th>
          <th>Qtde</th>
          <th style="width: 5%;" ></th>          
          <th style="width: 5%;" ></th>  
          <th style="width: 5%;" ></th>
        </tr>
        @foreach ($estocados as $e)
        <tr>
          <td                            > {{$e->nome_material}} </td>
          <td                            > {{$e->nome_local }} </td>
          <td                            > {{$e->lote }} </td>
          <td                            > {{$e->quantidade }} </td>
          <td style="text-align: center;"> <a href="/estoque/edita/{{$e->id}}"> <span class="fas fa-pencil-alt"> </span> </a> </td>
          <td style="text-align: center;"> <a href="/estoque/remove/{{$e->id}}"> <span class="fas fa-trash text-danger"></span> </a> </td>
          <td style="text-align: center;"> <a href="/estoque/ajusta/{{$e->id}}"> <span class="fas fa-balance-scale"></span> </a> </td>
        </tr>
        @endforeach
      </table>
        
      </div>
      
    </div><!--fim da listagem de locais-->


<div class="row p-3">
        @if ( $view['operacao'] == 'deletado' )
              <div class="alert alert-success" role="alert">
                <strong>Sucesso:</strong> O Material Estocado foi deletado do sistema com sucesso!
              </div>
            
        @elseif ( $view['operacao'] == 'naoDeletado' )
          <div class="alert alert-danger" role="alert">
            <strong>Atenção:</strong> O Material estocado NÃO pode ser deletado do sistema. É provavel que o mesmo tenha alguma movimentação associada!
          </div>
        @endif
  
</div>



  <div class="row">
    <div class="col d-flex justify-content-around mt-3" id="secao-botoes">
        <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-search"></i>Localizar</button>
        <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>
    </div>
  </div>

</form> <!-- fim do formulário-->






@endsection
