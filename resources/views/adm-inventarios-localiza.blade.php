@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="" action="/adm-inventarios/localizaInventarios"  method="post">
    <div class="form-row d-flex align-items-end">

        <div class="col-sm-12 col-md-6 form-group">
          <label for="nome_resp">Responsável</label>
          <input type="text" class="form-control" id="nome_resp" name="nome_respon" placeholder="responsável">
        </div>

        <div class="col-sm-12 col-md-6 form-group">
            <label for="data_inicio"> Data de Início</label>
            <div class="input-group">
              <input type="date" class="form-control" name="data_inicio_i">
              <input type="date" class="form-control" name="data_inicio_f">
            </div>
        </div>

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

    @isset ($inventarios)
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
            <td> {{$i->user->name}} </td>
            <td> {{$i->data_inicio}} </td>
            <td> {{$i->data_fim}} </td>
            <td> <a href="/adm-inventarios/exibeDetalhes/{{$i->cod_inventario}}"> <span class="far fa-eye">       </span> </a> </td>
          </tr>
        @endforeach

        </table>
      </div><!--fim da listagem de inventarios-->
    </div>
    @endisset


<div class="form-row">
        <div class="col-12 d-flex justify-content-around mt-5" id="">

            <button type="submit" class="btn btn-lg btn-success col-sm-5 col-md-3" ><i class="fas fa-search mr-2"></i>Localizar</button>

              <button type="reset" class="btn btn-lg btn-success col-sm-5 col-md-3" ><i class="fas fa-broom mr-2"  ></i>Limpar</button>

              <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-3" onclick="window.location.href='/adm-inventarios';" >
                  <i class="fas fa-ban mr-2"></i>Cancelar</button>
        </div>
</div>

</form> <!-- fim do formulário-->

</div>







@endsection
