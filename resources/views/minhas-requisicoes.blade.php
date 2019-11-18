@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form action="/minhas-requisicoes/localiza" class="" method="post">
    <div class="form-row d-flex align-items-end">

        <div class="col-sm-6 col-md-6 form-group">
          <label for="">Núm. Requisição</label>
          <input type="text" class="form-control" id="" placeholder="código">
        </div>

        <div class="col-sm-6 col-md-6 form-group">
          <label for="cod_tipo">Situação</label>
          <div class="input-group">
            <select class="form-control" id="cod_tipo" name="cod_tipo">
              <option value=""> Todas </option>
              <option value="Aberta"> Aberta </option>
              <option value="Finalizada"> Finalizada </option>
              <option value="Negada"> Negada </option>
            </select>
          </div>
        </div>

        <div class="col-sm-12 col-md-6 form-group">     
          <label for="idDataReqInicio">Data de Requisição</label>       
          <div class="input-group">
            <input type="date" class="form-control" id="idDataReqInicio"> 
            <input type="date" class="form-control" id="idDataReqFinal">            
          </div>             
        </div>  

        <div class="col-sm-12 col-md-6 form-group">
          <label for="idDataFinalizacaoInicio"> Data de Finalização</label>
          <div class="input-group">              
            <input type="date" class="form-control" id="idDataFinalizacaoInicio">  
            <input type="date" class="form-control" id="idDataFinalizacaoFinal">            
          </div>       
        </div>                       

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


    <div class="form-row">
      <div class="col-md-12" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <thead>
            <tr>
              <th>Número</th>
              <th>Data Requ. </th>
              <th>Data Atend.</th>  
              <th >Situação</th> 
              <th style="width: 5%;" ></th>          
              <th style="width: 5%;" ></th>          
              <th style="width: 5%;" ></th>         
            </tr>
          </thead>
          <tbody>
          @foreach ($requisicoes as $r)
            <tr>
              <td                            > {{$r->cod_requisicao}} </td>
              <td                            > {{$r->get_data_req_formatada() }} </td>
              <td                            > {{$r->get_data_atend_formatada() }} </td>
              <td                            > {{$r->situacao }} </td>
              <td style="text-align: center;"> @if( $r->data_atend  == null) <a href="/minhas-requisicoes/edita/{{$r->cod_requisicao}}"> <span class="fas fa-pencil-alt">   </span> </a> @endif </td>
              <td style="text-align: center;"> @if( $r->data_atend  == null) <a href="/minhas-requisicoes/remove/{{$r->cod_requisicao}}"> <span class="fas fa-trash text-danger"></span> </a> @endif </td>
              <td style="text-align: center;"> <a href="/minhas-requisicoes/exibeDetalhes/{{$r->cod_requisicao}}"> <span class="fas fa-eye"></span> </a> </td>
            </tr>
          @endforeach
          </tbody>


        </table>
      </div><!--fim da listagem de locais-->
    </div>


  <div class="form-row">
    <div class="col d-flex justify-content-around mt-3" id="secao-botoes">
        <button type="button" class="btn btn-lg btn-success" onclick="window.location.href='/requisicao';" > <i class="fas fa-plus ml-1"></i>Nova</button>
        <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-search"></i>Localizar</button>
        <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>
    </div>
  </div>

</form> <!-- fim do formulário-->
  
</div>


@endsection
