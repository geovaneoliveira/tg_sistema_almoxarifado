@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')
      
<form action="{{ session('unidade') ? '/unidade/atualiza' : '/unidade/adiciona'}}" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    
  <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
    <div class="col">           
      <div class="form-group">
        
        @if(session('unidade'))

          <label for="cod_unid_medida">Código da Unidade:</label>
          <input type="text" class="form-control" id="cod_unid_medida" name="cod_unid_medida" value="{{ session('unidade')->cod_unid_medida }}" readonly="readonly"/>

          <label for="descrUnidade">Unidade:</label>
          <input type="text" class="form-control" id="descrUnidade" name="descricao_unid_medida" value="{{ 
          session('unidade')->descricao_unid_medida }}" />
          
        @else

          <label for="descrUnidade">Unidade:</label>           
          <input type="text" class="form-control" id="descrUnidade" name="descricao_unid_medida" value="" />
        
        @endif

      </div>

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />   

    </div>

 </div> <!-- fim da div row da parte do forumulario--> 

  <div class="row" style="max-height: 225px; overflow-y: auto;"><!--inicio da listagem de unidade-->
    <div class="col">
      
      <table class="table table-sm table-bordered table-hover">
        <tr>
          <th>Unidade</th>
          <th style="width: 5%;" ></th>          
          <th style="width: 5%;" ></th>  
        </tr>
        @foreach ($unidades as $u)
          <tr>
            <td> {{$u->descricao_unid_medida}} </td>
            <td style="text-align: center;"> <a href="/unidade/edita/{{$u->cod_unid_medida}}"> <span class="fas fa-pencil-alt"> </span> </a> </td>
            <td style="text-align: center;"> <a href="/unidade/remove/{{$u->cod_unid_medida}}"> <span class="fas fa-trash text-danger"></span> </a> </td>         
          </tr>
        @endforeach
      </table>
      
    </div>
    <div class="col-12 mt-1 mb-1" style="text-align: center;">
      <label>Legenda:</label>   
      <span class="fas fa-pencil-alt text-primary ml-3 mr-1"> Editar </span>
      <span class="fas fa-trash text-danger ml-3 mr-1"> Excluir </span>              
    </div>
      
  </div><!--fim da listagem de unidades-->



  <div class="row mt-1 mb-1">
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
          <strong>Sucesso:</strong> A unidade foi excluída do sistema com sucesso!
        </div>
          
      @elseif ( session('status') == 'naoExcluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> A unidade NÃO pode ser excluída do sistema!
        </div>

      @elseif ( session('status') == 'incluido' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> A unidade foi adicionada com sucesso!
        </div>

      @elseif ( session('status') == 'naoIncluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> A unidade NÃO pode ser adicionada no sistema!
        </div>

      @elseif ( session('status') == 'editado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> A unidade foi atualizada com sucesso!
        </div>

      @elseif ( session('status') == 'naoEditado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> A unidade NÃO pode ser editada!
        </div>

      @endif

    </div>
  </div>


  <div class="row">
    <div class="col-md-12 d-flex justify-content-around mt-1" id="secao-botoes"> 

      @if(session('operacao')=='editar')
        <button type="submit" class="btn btn-lg btn-success col-3"><i class="far fa-save"></i>Salvar</button>
        <a href="/unidade" class="btn btn-lg btn-success col-3"><i class="fas fa-ban">  Cancelar</i></a>
      @else
        <button type="submit" class="btn btn-lg btn-success col-3"><i class="fas fa-check"></i>Cadastrar</button>          
      @endif
        
        <button type="reset" class="btn btn-lg btn-success col-3"><i class="fas fa-broom"></i>Limpar</button>    
    </div>
  </div>

</form> <!-- fim do formulário-->







  

  



@stop