@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">

<form class="">

	<div class="form-row d-flex align-items-end">

		<div class="col-md-3 form-group">
          <label >Número Requição </label>
          <input type="text" value="{{$requisicao->cod_requisicao}}" class="form-control" readonly />
        </div>

		<div class="col-md-6 form-group">
          <label >Nome do Requisitante</label>
          <input type="text" value="{{$requisicao->user->name}}" class="form-control" readonly />
        </div>

        <div class="col-md-3 form-group" readonly>
            <label for="">Data de Requisição</label>
            <div class="input-group" readonly>
              <input type="text" value="{{$requisicao->get_data_req_formatada()}}" class="form-control" id="" readonly> 
            </div>            
        </div>                  

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

</form>


<div class="row">
	<form class="col-md-12">
			<div class="form-row">
				<div class="col-md-12" style="height: 500px; overflow-y: scroll;" ><!--inicio da listagem de materiais-->
					@foreach ($requisicao->materiaisRequisitados as $mr)
					<table class="table table-sm table-bordered table-hover " style="text-align: center; border-color: green;" >
						<tr>
							<th class="thmaster" colspan="6" > {{$mr->material->nome_material}} - {{$mr->quantidade_req}}  {{$mr->material->unidade->descricao_unid_medida}}</th>
						</tr>
						<tr>
							<th style="width: 15%;" >Local </th>
							<th style="width: 15%;" >Disp</th>
							<th style="width: 15%;" >Lote</th>
							<th style="width: 15%;" >Validade</th>
							<th style="width: 15%;" >Qtde</th>	
							<th style="width: 5%;"  > </th>													
						</tr>
						@foreach ($mr->material->estoques as $e)
							<tr>
								<td> {{$e->local->nome_local}} </td>
								<td> {{$e->quantidade}} </td>
								<td> {{$e->lote}} </td>
								<td> {{$e->get_data_atend_formatada()}} </td>
								<td> <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" placeholder="qtde a retirar" />  </td>	
								<td style="text-align: center;"> <a href="#" onclick="ilimina( '{{$e->id}}' );"> <span class="fas fa-times text-danger"></span> </a> </td>	
							</tr >
						@endforeach
					</table>
  					@endforeach


				</div>
			</div>

			<div class="form-row mt-2">
				<div class="col-12 d-flex justify-content-around" id="">
	    			<button type="button" class="btn btn-lg btn-success" ><i class="fas fa-check  mr-2"></i>Finalizar</button>
					<button type="button" class="btn btn-lg btn-success" onclick="window.location.href='/saida';" > <i class="fas fa-ban mr-2"></i>Cancelar</button>
				</div>
			</div>
	</form>

</div>


	
</div>


@endsection
