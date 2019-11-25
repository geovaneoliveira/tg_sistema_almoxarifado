@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="">
      <fieldset class="border shadow-sm p-3">
      <legend>Inventário Ativo:</legend>

    <div class="form-row d-flex align-items-end">

        <div class="col-sm-12 col-md-3 form-group">
          <label for="">Cód.</label>
          <input type="text" class="form-control" id="" value="" readonly />
        </div>

        <div class="col-sm-12 col-md-6 form-group">
          <label for="">Responsável</label>
          <input type="text" class="form-control" id="" value="" readonly />
        </div>

        <div class="col-sm-12 col-md-3 form-group">
            <label for=""> Data de Início</label>
            <div class="input-group">
              <input type="date" class="form-control" id="" value="" readonly />
            </div>
        </div>
      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>
    <div class="form-row ">
        <div class="col-12 d-flex justify-content-around mt-4" id="">
              <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/analisa';"><i class="fas fa-check  mr-2"></i>Analisar</button>
              <button type="button" class="btn btn-lg btn-danger col-sm-5 col-md-4" > <i class="fas fa-trash mr-2"></i>Suspender</button>
        </div>
      </div>
    </fieldset>
</form> <!-- fim do formulário-->




        <div class="col-12 d-flex justify-content-around mt-5" id="">
              <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" disabled><i class="fas fa-plus mr-2"  ></i>Iniciar</button>
              <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/localiza';"><i class="fas fa-search mr-2"></i>Localizar</button>
        </div>




</div>







@endsection
