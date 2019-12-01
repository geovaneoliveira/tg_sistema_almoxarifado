@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

  <form action="/material/localiza" class="ml-4 mr-4" method="post"> <!-- início do formulario -->


  <div class="row">  

    <div class="d-flex flex-wrap col p-0">

      <div class="form-group col-md-6">
                    <label for="nome_material">Nome do Material:</label>
                    <input type="text" class="form-control" id="nome_material" name="nome_material">
            </div>

            <div class="form-group col-md-6">
              <label for="cod_tipo">Tipo de Material:</label>
               <div class="input-group" >
                 <select class="form-control" id="cod_tipo" name="cod_tipo">
                        <option value=""></option>
                     @foreach($tipos as $c)
                        <option value="{{$c->cod_tipo}}">{{$c->nome_tipo}}</option>
                     @endforeach
                 </select>
              </div>
            </div>


            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

     </div>   


  </div>

    @isset($materiais)
      <div class="row" style="max-height: 225px; overflow-y: auto;" ><!--inicio da listagem de locais-->
        <div class="col-12">
          <table class="table table-sm table-bordered table-hover">
              <tr>
                <th>Material</th>
                <th>Tipo</th>
                <th>Unidade</th>
                <th>Total</th>
                <th style="width: 5%;" ></th>          
                <th style="width: 5%;" ></th>  
                <th style="width: 5%;" ></th> 
              </tr>
            @foreach ($materiais as $m)
              <tr>
                    <td                            > {{$m->nome_material}} </td>
                    <td                            > {{$m->tipo->nome_tipo }} </td>
                    <td                            > {{$m->unidade->descricao_unid_medida }} </td>
                    <td                            > {{$m->calcQtdeTotal()}} </td>
                    <td style="text-align: center;"> <a href="/material/edita/{{$m->cod_material}}"> <span class="fas fa-pencil-alt"> </span> </a> </td>
                    <td style="text-align: center;"> <a href="/material/consulta/remove/{{$m->cod_material}}"> <span class="fas fa-trash text-danger"></span> </a> </td>
                    <td style="text-align: center;"> <a href="/material/aloca/{{$m->cod_material}}"> <span class="fas fa-box-open text-success"></span> </a> </td>
              </tr>
            @endforeach
        </table>          
        </div>

        </div><!--fim da listagem de locais-->
          <div class="col-12 mt-1 mb-1" style="text-align: center;">
          <label>Legenda:</label>   
          <span class="fas fa-pencil-alt text-primary ml-3 mr-1"> Editar </span>
          <span class="fas fa-trash text-danger ml-3 mr-1"> Excluir </span>
          <span class="fas fa-box-open text-success ml-3"> Alocar </span>        
        </div>


          
      
    @endisset

  <div class="row mt-1 mb-1">
    <div class="col-12">
  
      @if ( session('status') == 'excluido' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material foi excluído do sistema com sucesso!
        </div>
          
      @elseif ( session('status') == 'naoExcluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material NÃO pode ser excluído do sistema!
        </div>

      @elseif ( session('status') == 'incluido' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material foi adicionado com sucesso!
        </div>

      @elseif ( session('status') == 'naoIncluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material NÃO pode ser adicionado no sistema!
        </div>

      @elseif ( session('status') == 'editado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material foi atualizado com sucesso!
        </div>

      @elseif ( session('status') == 'naoEditado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material NÃO pode ser editado!
        </div>

       @elseif ( session('status') == 'alocado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material foi alocado com sucesso no estoque!
        </div>

      @elseif ( session('status') == 'naoAlocado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material NÃO pode ser alocado!
        </div>

      @endif
  
    </div>
  </div>





    <div class="row mt-1">
      <div class="col d-flex justify-content-around " id="secao-botoes">
        <button type="button" class="btn btn-lg btn-success col-3" onclick="window.location.href='/material';" > <i class="fas fa-plus"></i>Novo</button>

        @if(session('operacao')=='editar')
          <button type="submit" class="btn btn-lg btn-success col-3"><i class="far fa-save"></i>Salvar</button>
          <button type="button" class="btn btn-lg btn-success col-3" onclick="window.location.href='/user/gerenciar';" > <i class="fas fa-ban"></i>Cancelar</button>
        @else
          <button type="submit" class="btn btn-lg btn-success col-3"><i class="fas fa-search"></i>Localizar</button>
        @endif

          <button type="reset" class="btn btn-lg btn-success col-3"><i class="fas fa-broom"></i>Limpar</button>
          
      </div>
    </div>

  </form> <!-- fim do formulário-->






@endsection
