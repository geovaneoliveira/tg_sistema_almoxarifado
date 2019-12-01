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

  @isset($estocados)
    <div class="row mb-1 mt-1" style="max-height: 225px; overflow-y: auto;" ><!--inicio da listagem de locais-->
      <div class="col-12">
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


    <div class="col-12 mt-1 mb-1" style="text-align: center;">
      <label>Legenda:</label>   
      <span class="fas fa-pencil-alt text-primary ml-3 mr-1"> Editar </span>
      <span class="fas fa-trash text-danger ml-3 mr-1"> Excluir </span>
      <span class="fas fa-balance-scale text-primary ml-3"> Ajustar </span>        
    </div>

  @endisset

  <div class="row mt-1 mb-1">
    <div class="col-12">

      @if ( session('status') == 'excluido' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material estocado foi excluído do sistema com sucesso!
        </div>
          
      @elseif ( session('status') == 'naoExcluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material estocado NÃO pode ser excluído do sistema!
        </div>

      @elseif ( session('status') == 'editado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material estocado foi atualizado com sucesso!
        </div>

      @elseif ( session('status') == 'naoEditado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material estocado NÃO pode ser editado!
        </div>

      @elseif ( session('status') == 'ajustado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material estocado foi ajustado com sucesso!
        </div>

      @elseif ( session('status') == 'naoAjustado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material estocado NÃO pode ser ajustado!
        </div>

      @endif
        
    </div>
  </div>



  <div class="row">
    <div class="col-12 d-flex justify-content-around mt-1" id="secao-botoes">
        <button type="submit" class="btn btn-lg btn-success col-3"><i class="fas fa-search"></i>Localizar</button>
        <button type="reset" class="btn btn-lg btn-success  col-3"><i class="fas fa-broom"></i>Limpar</button>
    </div>
  </div>

</form> <!-- fim do formulário-->






@endsection
