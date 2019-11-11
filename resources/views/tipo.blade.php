@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')
         
  <form action="{{ session('tipo') ? '/tipo/atualiza' : '/tipo/adiciona'}}" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
      <div class="col">           
 
              @if(session('tipo'))
              <div class="form-group">
                <label for="cod_tipo">Código do Tipo:</label>
                <input type="text" class="form-control" id="cod_tipo" name="cod_tipo"  value="{{ session('tipo')->cod_tipo }}" readonly="readonly"/>                     
              </div>

              <div class="form-group">                
                <label for="nomeTipo">Tipo de Material:</label>
                <input type="text" class="form-control" id="nomeTipo" name="nome_tipo"  value="{{ session('tipo')->nome_tipo }}" />
              </div>
              @else   
              <div class="form-group">
                <label for="nomeTipo">Tipo de Material:</label>           
                <input type="text" class="form-control" id="nomeTipo" name="nome_tipo"  value="" />
              </div>
              @endif
              <div class="form-group">
                <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
              </div>
        </div>
     </div> <!-- fim da div row da parte do forumulario--> 

      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @else
        @if(old('nome_tipo') && session('operacao')=='incluido')
        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> Tipo {{old('nome_tipo')}} foi adicionado!
        </div>
        @endif

        @if(session('operacao')=='atualizado')
        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> Tipo {{old('nome_tipo')}} foi atualizado!
        </div>
      @endif

      @endif

      

 
 




<div class="row" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de tipos-->
  <div class="col">
    <table class="table table-sm table-bordered table-hover">
        <tr>
          <th>Tipo</th>
          <th style="width: 5%;" ></th>          
          <th style="width: 5%;" ></th>  
        </tr>
        @foreach ($tipos as $t)
          <tr>
                <td> {{$t->nome_tipo}} </td>
                <td style="text-align: center;"> <a href="/tipo/edita/{{$t->cod_tipo}}"> <span class="fas fa-pencil-alt"> </span> </a> </td>
                <td style="text-align: center;"> <a href="/tipo/remove/{{$t->cod_tipo}}"> <span class="fas fa-trash text-danger"></span> </a> </td>         
          </tr>
        @endforeach
    </table>
    
  </div>
    
  </div><!--fim da listagem de tipos-->

    



    <div class="row">
      <div class="col-md-12 d-flex justify-content-around mt-5" id="secao-botoes"> 

        @if(session('operacao')=='editar')
          <button type="submit" class="btn btn-lg btn-success"><i class="far fa-save"></i>Salvar</button>
          <a href="/tipo" class="btn btn-lg btn-success"><i class="fas fa-ban">  Cancelar</i></a>
        @else
          <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-check"></i>Cadastrar</button>          
        @endif
          
          <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>    
      </div>
    </div>

  </form> <!-- fim do formulário-->







  

  



@stop