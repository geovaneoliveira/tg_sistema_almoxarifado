@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="" action="/adm-inventarios/analisa/localizar" method="post">

    <fieldset class="border shadow-sm p-3">
    <legend>Inconsistências:</legend>

    <div class="form-row d-flex align-items-end">

          <div class="col-sm-6 col-md-4  form-group">
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

          <div class="col-sm-6 col-md-4 form-group">
            <label for="cod_tipo">Tipo de Material:</label>
            <div class="input-group" >
              <select class="form-control" id="cod_tipo" name="cod_tipo">
                <option value="">todos</option>
                @foreach($tipos as $t)
                <option value="{{$t->cod_tipo}}">{{$t->nome_tipo}}</option>
                @endforeach
              </select>
            </div>
          </div>

          <div class="col-sm-6 col-md-4  form-group">
            <label for="contagem">Contagem</label>
            <div class="input-group">
              <select class="form-control" id="contagem" name="contagem">
                <option value="i"> Inventariados </option>
                <option value="notI"> Não inventariados</option>
                <option value="all"> Todos </option>
              </select>
            </div>
          </div>

          <div class="col-sm-6 col-md-4 form-group ">
            <fieldset class="border p-2">
              <legend class=" m-0 p-0" style="font-size: 1em;">Situação</legend>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Avaliados" id="situacao" name="situacao[]">
                <label class="form-check-label" for="situacao">
                Avaliados
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="Não Avaliados" id="situacao" name="situacao[]">
                <label class="form-check-label" for="situacao">
                Não Avaliados
              </div>

            </fieldset>
          </div>

          <div class="col-sm-6 col-md-4 form-group">
            <label for="nome_material">Material</label>
            <input type="text" class="form-control" id="nome_material" name="nome_material" placeholder="parte do nome do material">
          </div>

          <div class="col-sm-6 col-md-4 form-group">
            <label for="lote">Lote</label>
            <input type="text" class="form-control" id="lote" name="lote" placeholder="parte núm. lote">
          </div>


          <div class="form-group col-sm-6 col-md-4 " >
                  <button type="submit" class="btn btn-success" style="width: 100%;"><i class="fas fa-search mr-2"></i>Localizar</button>
          </div>

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

    <div class="form-row">
      <div class="col-md-12" style="max-height:400px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr>
            <th>Est.</th>
            <th>Material </th>
            <th>Lote </th>
            <th>Local</th>
            <th>Qtde </th>
            <th>Unid </th>
            <th>Contador </th>
            <th>Qtde </th>
            <th > <i class="fas fa-check-double " > </th>
          </tr>
          @foreach($materialinventariado as $i)
          <tr>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->id}}  </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->material->nome_material}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->lote}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->local->nome_local}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}" > {{$i->estoque->quantidade}} </td>
            <td rowspan="{{$i->contagens->count() + 1}}"> {{$i->estoque->material->unidade->descricao_unid_medida}} </td>
            @if ($i->contagens->count() == 0)
              <td rowspan="{{$i->contagens->count() + 1}}" colspan="3" class="text-danger"> nenhuma contagem </td>
            @endif
          </tr>
            @foreach($i->contagens as $co)
              <tr>
                  <td> {{$co->user->name}} </td>
                  <td> {{$co->qtde_contada}} </td>
                  <td> <a id="id_btn_contagem_{{$co->id}}" onclick="btn_contagem('{{$i->id}}', '{{$co->id}}');"  class="classe_btn_contagem_{{$i->id}}">
                    <span class="
                      @if($i->qtde_estoque_real)
                        @if($i->qtde_estoque_real == $co->qtde_contada)
                          fas fa-check-double text-primary
                        @else
                          far fa-circle text-success
                        @endif
                      @else
                          far fa-circle text-success
                      @endif

                    "></span> </a> </td>
              </tr>
            @endforeach
          @endforeach
        </table>
      </div><!--fim da listagem de locais-->
    </div>

</fieldset>
<div class="row mt-4">
        <div class="col-12 d-flex justify-content-around" id="">
          <button type="button" class="btn btn-lg btn-warning col col-md-6" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-check-double  mr-2" > </i>Finalizar Inventário</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Suspender Inventário Ativo!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Você tem certeza que deseja finalizar o inventário? Esta opção não pode ser desfeita!
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" data-dismiss="modal"><i class="fas fa-arrow-left mr-2"></i>Voltar</button>
                <button type="button" class="btn btn-lg btn-warning col-sm-5 col-md-4" data-dismiss="modal" onclick="window.location.href='/adm-inventarios/finalizar';"><i class="fas fa-check-double  mr-2"></i>Finalizar</button>

              </div>
            </div>
          </div>
        </div>



      </div>
</form> <!-- fim do formulário-->










</div>
@push('scripts')

<script>



    function btn_contagem(idMaterialInventariado, idContagem) {

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
          var classe_btn_contagem = document.getElementsByClassName('classe_btn_contagem_' + idMaterialInventariado);
          var i;
          for (i = 0; i < classe_btn_contagem.length; i++) {
            classe_btn_contagem[i].innerHTML = '<span  class="far fa-circle text-success">   </span>';
          }

          document.getElementById('id_btn_contagem_' + idContagem).innerHTML = '<span  class="fas fa-check-double text-primary">   </span>';
      }
    };

    xhttp.open("GET", "/adm-inventarios/selecionaContagem/" + idContagem , true);
    xhttp.send();

  }

</script>
@endpush


@endsection
