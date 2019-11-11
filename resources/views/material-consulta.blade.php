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


      <div class="row" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de locais-->
        <div class="col">
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







    <div class="row">
      <div class="col d-flex justify-content-around mt-3" id="secao-botoes">
        <button type="button" class="btn btn-lg btn-success" onclick="window.location.href='/material';" > <i class="fas fa-plus"></i>Novo</button>

        @if(session('operacao')=='editar')
          <button type="submit" class="btn btn-lg btn-success"><i class="far fa-save"></i>Salvar</button>
          <button type="button" class="btn btn-lg btn-success" onclick="window.location.href='/user/gerenciar';" > <i class="fas fa-ban"></i>Cancelar</button>
        @else
          <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-search"></i>Localizar</button>
        @endif

          <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>
          
      </div>
    </div>

  </form> <!-- fim do formulário-->






@endsection
