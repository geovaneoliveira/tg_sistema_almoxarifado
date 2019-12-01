@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form action="/saida/localiza" class="" method="post">
    <div class="form-row d-flex align-items-end">

        <div class="col-sm-6 col-md-4 form-group">
          <label for="">Núm. Requisição</label>
          <input type="text" class="form-control" id="" name="cod_requisicao" placeholder="código">
        </div>

        <div class="col-sm-6 col-md-4 form-group">
          <label for="id_situacao">Situação</label>
          <div class="input-group">
            <select class="form-control" id="id_situacao" name="situacao">
              <option value=""> Todas </option>
              <option value="Aberta"> Aberta </option>
              <option value="Finalizada"> Finalizada </option>
              <option value="Negada"> Negada </option>
            </select>
          </div>
        </div>

        <div class="col-sm-12 col-md-4 form-group">
          <label for="nome_requisitante_id">Requisitante</label>
          <input type="text" class="form-control" id="nome_requisitante_id" name="nome_requisitante" placeholder="parte do nome do requisitante">
        </div>

        <div class="col-sm-12 col-md-6 form-group">
          <label for="idDataReqInicio">Data de Requisição</label>       
          <div class="input-group">
            <input type="date" class="form-control" id="idDataReqInicio" name="data_req_inicial"> 
            <input type="date" class="form-control" id="idDataReqFinal" name="data_req_final">            
          </div>             
        </div>  

        <div class="col-sm-12 col-md-6 form-group">
          <label for="idDataFinalizacaoInicio"> Data de Finalização</label>
          <div class="input-group">              
            <input type="date" class="form-control" id="idDataFinalizacaoInicio" name="data_atend_inicial">  
            <input type="date" class="form-control" id="idDataFinalizacaoFinal" name="data_atend_final">            
          </div>           
        </div>                       

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

    @isset($requisicoes)
      <div class="form-row">
        <div class="col-md-12" style="max-height: 225px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
          <table class="table table-sm table-bordered table-hover " style="text-align: center;">
            <thead>
              <tr>
                <th>Número</th>
                <th>Requisitante</th>
                <th>Data Requ. </th>
                <th>Data Atend.</th>  
                <th>Situação</th>
                <th style="width: 5%;" ></th>          
                <th style="width: 5%;" ></th> 
                <th style="width: 5%;" ></th>         
              </tr>
            </thead>
            <tbody>              
              @foreach ($requisicoes as $r)
                <tr>
                  <td                            > {{$r->cod_requisicao}} </td>
                  <td                            > {{$r->user->name}} </td>
                  <td                            > {{$r->get_data_req_formatada() }} </td>
                  <td                            > {{$r->get_data_atend_formatada() }} </td>
                  <td                            > {{$r->situacao }} </td>
                  <td style="text-align: center;"> @if ($r->situacao != 'Finalizada') <a href="/saida/nega/{{$r->cod_requisicao}}"> <span class="fas fa-minus-circle text-{{$r->situacao == 'Aberta' ? 'danger' : 'secondary' }}"></span> </a> @endif </td>
                  <td style="text-align: center;"> <a href="/saida/exibeDetalhes/{{$r->cod_requisicao}}"> <span class="far fa-eye"></span> </a></td>
                  <td style="text-align: center;"> @if( $r->situacao == 'Aberta' ) <a href="/saida/atende/{{$r->cod_requisicao}}"> <span class="fas fa-dolly-flatbed text-success"></span>  </a> @endif </td>
                </tr>
              @endforeach              
            </tbody>
          </table>
        </div>
      </div>
        <div class="col-12 mt-1 mb-1" style="text-align: center;">
          <label>Legenda:</label>   
          <span class="fas fa-minus-circle text-danger ml-3 mr-1"> Recusar </span>
          <span class="fas fa-eye text-primary ml-3 mr-1"> Detalhes </span> 
          <span class="fas fa-dolly-flatbed text-success ml-3"> Atender </span>                 
        </div>
    @endisset


    <div class="row"> 
      <div class="col-12">
        @if(session('status')=='negada')
          <div class="alert alert-success" role="alert">
            Requisição negada com sucesso.
          </div>
        @elseif(session('status')=='naoNegada')
          <div class="alert alert-danger" role="alert">
              A requisição não pode ser negada.
          </div>
        @elseif(session('status')=='aberta')
          <div class="alert alert-success" role="alert">
            Requisição aberta com sucesso.
          </div>
        @elseif(session('status')=='naoAberta')
          <div class="alert alert-danger" role="alert">
              A requisição não pode ser aberta.
          </div>
        @endif        
      </div>
    </div>

    <div class="form-row">
      <div class="col d-flex justify-content-around mt-1" id="secao-botoes">
        <button type="submit" class="btn btn-lg btn-success col-3"><i class="fas fa-search"></i>Localizar</button>
        <button type="reset" class="btn btn-lg btn-success col-3"><i class="fas fa-broom"></i>Limpar</button>
      </div>
    </div>

  </form> <!-- fim do formulário-->
  
</div>







@endsection
