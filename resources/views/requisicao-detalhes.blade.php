@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">

<form class="mt-4">

	<div class="form-row d-flex align-items-end">

		<div class="col-md-4 form-group">
          <label for="">Número Requição </label>
          <input type="text" value="{{ $requisicao->cod_requisicao }}" class="form-control" readonly />
        </div>

		<div class="col-md-8 form-group">
          <label for="">Nome do Requisitante</label>
          <input type="text" value="{{ $requisicao->user->name }}" class="form-control" readonly />
        </div>

        <div class="col-md-4 form-group">
          <label for="">Situacão</label>
          <input type="text" value="{{ $requisicao->situacao }}" class="form-control" readonly />
        </div>

        <div class="col-md-4 form-group" readonly>
            <label for="">Data de Requisição</label>
            <div class="input-group" readonly>
              <input type="text" value="{{ $requisicao->get_data_req_formatada() }}" class="form-control" readonly> 
            </div>            
        </div>  

        <div class="col-md-4 form-group">
            <label for="">Data de Finalização</label>
            <div class="input-group">           
              <input type="text" value="{{ $requisicao->get_data_atend_formatada() }}"class="form-control" readonly >
            </div>            
        </div>                       

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


		<div class="form-row" >
			<div class="col-md-12" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
				<table class="table table-sm table-bordered table-hover " style="text-align: center;">
					<thead>
					<tr scope="row">
						<th style="width: 50%;" >Material</th>
						<th style="width: 20%;" >Tipo</th>
						<th style="width: 10%;" >Qtde.</th>
						<th style="width: 10%;" >Atend.</th>
						<th style="width: 10%;" >Unid.</th>
					</tr>
					</thead>

  					<tbody>
  						@foreach ($requisicao->materiais_requisitados as $mr)
  							<tr scope="row">
								<td style="text-align: left;" > {{$mr->material->nome_material}}</td>
								<td                           > {{$mr->material->tipo->nome_tipo}}</td>
								<td                           > {{$mr->quantidade_req}} </td>
								<td                           > {{$mr->calcQtdeAtend()}} </td>
								<td                           > {{$mr->material->unidade->descricao_unid_medida}}  </td>
							</tr>
  						@endforeach
				</tbody>	
				</table>
			</div><!--fim da listagem de locais-->
		</div>

		<div class="form-row">
		    <div class="col d-flex justify-content-around mt-3" id="secao-botoes">
		        <button type="button" class="btn btn-lg btn-success" onclick="history.back()" > <i class="fas fa-arrow-left"></i>Voltar</button>
		    </div>
  		</div>


</form>
	
</div>


@endsection
