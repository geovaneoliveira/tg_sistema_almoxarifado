@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<form action="{{ session('local') ? '/local/atualiza' : '/local/adiciona'}}" class="ml-4 mr-4" method="post" id="form_local_id">
  
  <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
    <div class="col">           
      <div class="form-group">
              
        @if(session('local'))
          <div class="form-group">
            <label for="cod_local">Código do Local:</label>
            <input type="text" class="form-control " id="cod_local" name="cod_local" value="{{ session('local')->cod_local }}" readonly="readonly"/>              
          </div>

          <div class="form-group">
            <label for="nome_local">Local:</label>
            <input type="text" class="form-control" id="nomeLocal" name="nome_local" value="{{ session('local')->nome_local }}" />                
          </div>            
                
        @else  
          <div class="form-group">
            <label for="nomeLocal">Local:</label>           
            <input type="text" class="form-control" id="nomeLocal" name="nome_local" value="" />                
          </div>                
        @endif
      </div>
            
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

    </div> 
 
  </div> <!-- fim da div row da parte do forumulario--> 

  @isset($locais)
  <div class="row" style="max-height: 225px; overflow-y: auto;" ><!--inicio da listagem de locais-->
    <div class="col">
      <table class="table table-sm table-bordered table-hover">
        <tr>
          <th>Local</th>
          <th style="width: 5%;" ></th>          
          <th style="width: 5%;" ></th>          
        </tr>
        @foreach ($locais as $l)
          <tr>
            <td > {{$l->nome_local}} </td>
            <td style="text-align: center;"> <a href="/local/edita/{{$l->cod_local}}"> <span class="fas fa-pencil-alt"> </span> </a> </td>
            <td style="text-align: center; "> <a href="/local/remove/{{$l->cod_local}}"> <span class="fas fa-trash text-danger"></span> </a> </td>         
          </tr>
        @endforeach
      </table>
    </div><!--fim da listagem de locais-->    
  </div>
  <div class="col-12 mt-1 mb-1" style="text-align: center;">
    <label>Legenda:</label>   
    <span class="fas fa-pencil-alt text-primary ml-3 mr-1"> Editar </span>
    <span class="fas fa-trash text-danger ml-3"> Excluir </span>       
  </div>
  @endisset


  <div class="row mt-1">
    <div class="col-12">

      @if (count($errors) > 0)

        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>

      @endif

  
      @if ( session('status') == 'excluido' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O local foi excluído do sistema com sucesso!
        </div>
          
      @elseif ( session('status') == 'naoExcluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O local NÃO pode ser excluído do sistema!
        </div>

      @elseif ( session('status') == 'incluido' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O local foi adicionado com sucesso!
        </div>

      @elseif ( session('status') == 'naoIncluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O local NÃO pode ser adicionado no sistema!
        </div>

      @elseif ( session('status') == 'editado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O local foi atualizado com sucesso!
        </div>

      @elseif ( session('status') == 'naoEditado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O local NÃO pode ser editado!
        </div>

      @endif
 
    </div>
  </div>
  

  <div class="row">
    <div class="col-md-12 d-flex justify-content-around mt-1" id="secao-botoes"> 

      @if(session('operacao')=='editar')
        <button type="submit" class="btn btn-lg btn-success col-3"><i class="far fa-save"></i>Salvar</button>
        <a href="/local" class="btn btn-lg btn-success col-3"><i class="fas fa-ban">  Cancelar</i></a>
      @else
        <button type="submit" class="btn btn-lg btn-success col-3"><i class="fas fa-check"></i>Cadastrar</button>          
      @endif
        <button type="button" class="btn btn-lg btn-success col-3" onclick="localizar();"><i class="fas fa-search"></i>Localizar</button>        
        <button type="reset" class="btn btn-lg btn-success col-3"><i class="fas fa-broom"></i>Limpar</button>    
    </div>
  </div>

</form> <!-- fim do formulário-->


  @push('scripts')

    <script>
      function localizar(){
        document.getElementById('form_local_id').action = "/local/localiza";
        document.getElementById('form_local_id').submit();
      }
    </script>

  @endpush

@endsection