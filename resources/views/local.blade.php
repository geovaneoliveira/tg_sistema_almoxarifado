@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

  <form action="{{ session('local') ? '/local/atualiza' : '/local/adiciona'}}" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    
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






<div class="row" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de locais-->
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

<div class="row p-3">

       @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @else
        @if(old('nome_local') && session('operacao')=='incluido')
        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> Local {{old('nome_local')}} foi adicionado!
        </div>
        @endif

        @if(session('operacao')=='atualizado')
        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> Local {{old('nome_local')}} foi atualizado!
        </div>
      @endif

      @endif

      
        @if ( $view['operacao'] == 'deletado' )
              <div class="alert alert-success" role="alert">
                <strong>Sucesso:</strong> O Local foi deletado do sistema com sucesso!
              </div>
            
        @elseif ( $view['operacao'] == 'naoDeletado' )
          <div class="alert alert-danger" role="alert">
            <strong>Atenção:</strong> O local NÃO pode ser deletado do sistema!
          </div>
        @endif
  
</div>

    <div class="row">
      <div class="col-md-12 d-flex justify-content-around mt-5" id="secao-botoes"> 

        @if(session('operacao')=='editar')
          <button type="submit" class="btn btn-lg btn-success"><i class="far fa-save"></i>Salvar</button>
          <a href="/local" class="btn btn-lg btn-success"><i class="fas fa-ban">  Cancelar</i></a>
        @else
          <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-check"></i>Cadastrar</button>          
        @endif
          
          <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>    
      </div>
    </div>

  </form> <!-- fim do formulário-->







  

  



@endsection