@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="">
    <div class="form-row d-flex align-items-end">

        <div class="col-sm-12 col-md-6 form-group">
          <label for="cod_resp">Responsável</label>
          <input type="text" class="form-control" id="cod_resp" name="cod_resp" placeholder="responsável">
        </div>

        <div class="col-sm-12 col-md-6 form-group">
            <label for="data_inicio"> Data de Início</label>
            <div class="input-group">
              <input type="date" class="form-control" id="data_inicio" name="data_inicio">
              <input type="date" class="form-control" id="data_inicio" name="data_inicio">
            </div>
        </div>

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


    <div class="form-row">
      <div class="col-md-12" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr>
            <th>Cód.</th>
            <th>Responsável </th>
            <th>Iniciado</th>
            <th>Finalizado</th>
            <th style="width: 5%;" ></th>
          </tr>
        @foreach($inventarios as $i)
          <tr>
            <td> {{$i->cod_inventario}} </td>
            <td> {{$i->cod_resp}} </td>
            <td> {{$i->data_inicio}} </td>
            <td> {{$i->data_fim}} </td>
            <td> <a href="/adm-inventarios/exibeDetalhes/11"> <span class="far fa-eye">       </span> </a> </td>
          </tr>
        @endforeach

        </table>
      </div><!--fim da listagem de inventarios-->
    </div>


<div class="form-row">
        <div class="col-12 d-flex justify-content-around mt-5" id="">

            <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-3" onclick="window.location.href='/adm-inventarios/localiza';"><i class="fas fa-search mr-2"></i>Localizar</button>

              <button type="reset" class="btn btn-lg btn-success col-sm-5 col-md-3" ><i class="fas fa-broom mr-2"  ></i>Limpar</button>

              <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-3" onclick="window.location.href='/adm-inventarios';" >
                  <i class="fas fa-ban mr-2"></i>Cancelar</button>
        </div>
</div>

</form> <!-- fim do formulário-->

</div>







@endsection
