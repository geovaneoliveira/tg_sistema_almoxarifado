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
						<thead>
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
						</thead>

						<tbody>
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
						</tbody>	
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



@push('scripts')
   	<script>

   		var arrayMateriaisRequisicao = [];
   		var cod_requisicao = 0;

   		cod_requisicao = "{{$requisicao->cod_requisicao}}";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
	          	arrayMateriaisRequisicao = JSON.parse(this.responseText);
	          	for (m in arrayMateriaisRequisicao ) {
	          		console.log(arrayMateriaisRequisicao[m]);
	          	};  
	          	
          	}
        };
        xhttp.open("GET", "/saida/localizaMateriaisRequisitadosComEstoques/" + cod_requisicao , true);
        xhttp.send();







		function atualizaLista() {
	   		var listagemRequisitar = document.getElementById('listagemRequisicao');
	      	listagemRequisitar.innerHTML = '';
	      	for (m in arrayMateriaisRequisicao ) {
	      		var linha = listagemRequisitar.insertRow();
	      		linha.insertCell(0).innerHTML = arrayMateriaisRequisicao[m].nome_material;
	      		linha.insertCell(1).innerHTML = arrayMateriaisRequisicao[m].nome_tipo;
	      		let input = document.createElement('input');
	      		input.type = 'text';
	      		input.value = arrayMateriaisRequisicao[m].quantidade_req;
	      		input.id = 'input_quantidade_id_' + m;
	      		input.placeholder = 'digite qtde...';
	      		input.onkeyup = function() {
	      			let id = this.id.replace('input_quantidade_id_', '');
	      			if( ! isNaN(input.value) ) {
	      				arrayMateriaisRequisicao[id].quantidade_req = input.value;
	      				input.className = '';
	      			}else{
	      				input.className = 'bg-danger';
	      			}   			
	      		};
		      	linha.insertCell(2).append(input);
	      		linha.insertCell(3).innerHTML = arrayMateriaisRequisicao[m].descricao_unid_medida;
	      		let btnRemove = document.createElement('button');
	      		btnRemove.className = "btn btn-link";
	      		btnRemove.innerHTML = '<i class="fas fa-times text-danger"> </i>';
	      		btnRemove.id = 'btn_material_remove_id_' + m;
	      		btnRemove.type = "button";
	      		btnRemove.onclick = function() {
	      			let id = this.id.replace('btn_material_remove_id_', '');
	      			remove(arrayMateriaisRequisicao[id]);
	      			atualizaLista();
	      		};
	      		linha.insertCell(4).append(btnRemove);
	   		}

	   		if(document.getElementById('btn_requisitar')){
	   			if (arrayMateriaisRequisicao.length > 0) {
	   				document.getElementById('btn_requisitar').disabled = false;
		   		}
		   		else{
		   			document.getElementById('btn_requisitar').disabled = true;
		   		}

	   		}
	   		
	   	}






	</script>
@endpush

@endsection
