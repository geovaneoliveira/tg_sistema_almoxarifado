@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">

	<form class="">
		<fieldset class="border shadow-sm p-3">
			<legend>Estoque:</legend>

			<div class="form-row d-flex align-items-end">

			    <div class="col-sm-12 col-md-5 form-group">
			      <label for="nome_material">Desc. Material</label>
			      <input type="text" class="form-control" id="nome_material" name="nome_material" placeholder="Parte da descrição de um material">
			    </div>

			   	<div class="col-sm-8 col-md-4 form-group">
			      	<label for="cod_tipo">Tipo</label>
	                 	<select class="form-control" id="cod_tipo" name="cod_tipo">
	                     	<option value=""></option>
	                     	@foreach($tipos as $t)
	                        <option value="{{$t->cod_tipo}}">{{$t->nome_tipo}}</option>
	                     	@endforeach
	                 	</select>
			    </div>

			    <div class="form-group col-sm-4 col-md-3">
			    	<button type="button" class="btn btn-success" style="width: 100%;" onclick="localizarEstocados();"><i class="fas fa-search  mr-2"></i>Localizar</button>
				</div>

				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

		 	</div>

			<div class="form-row">
				<div class="col-md-12" style="height: 170px; overflow-y: scroll;" >
					<table class="table table-sm table-bordered table-hover " style="text-align: center;">
						<thead>
							<tr>
								<th style="width: 50%;" >Material</th>
								<th style="width: 20%;" >Tipo</th>
								<th style="width: 15%;" >Disponivel</th>
								<th style="width: 10%;" >Unid.</th>						
								<th style="width: 5%;" > </th>
							</tr>		
						</thead>						
						<tbody id="listagemEstoque">
						</tbody>
					</table>
				</div>
			</div>

		</fieldset>

	</form>


	<form class="mt-4">
		<fieldset class="border shadow-sm p-3">
		<legend>Requição: <strong id="legend_num_req_id">Nova</strong> </legend>
			<div class="form-row">
				<div class="col-md-12" style="height: 170px; overflow-y: scroll;" >
					<table class="table table-sm table-bordered table-hover " style="text-align: center;">
						<thead>
							<tr scope="row">
								<th style="width: 50%;" >Material</th>
								<th style="width: 20%;" >Tipo </th>
								<th style="width: 15%;" >Qtde </th>
								<th style="width: 10%;" >Unid.</th>						
								<th style="width: 5%;"  >     </th>
							</tr>
						</thead>
						<tbody id="listagemRequisicao">
						</tbody>
					</table>
				</div>
			</div>


			<div class="form-row">
				<div class="col-12 d-flex justify-content-around" id="">
				@isset($operacao)
	    			@if($operacao=='edita')
	    				<button id="btn_requisitar"  type="button" class="btn btn-lg btn-success col-3"  onclick="requisitar();"  ><i class="far fa-save mr-2"></i>Salvar</button>
					@endif

					@if($operacao=='abreForm')
	    				<button id="btn_requisitar" type="button" class="btn btn-lg btn-success col-3" onclick="requisitar();" disabled><i class="fas fa-check  mr-2"></i>Requisitar</button>
					@endif
				@endisset
				<button type="button" class="btn btn-lg btn-success col-3" onclick="window.location.href='/requisicao';" > <i class="fas fa-ban mr-2"></i>Cancelar</button>
				</div>
			</div>
		</fieldset>
	</form>
	
</div>


<!-- Modal do protocolo-->
<div class="modal fade" id="protocoloModal" tabindex="-1" role="dialog" aria-labelledby="protocoloModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="protocoloModalLabel">Protocolo de Requisição</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id='id_Modal_msg'>
      	@isset($operacao) @if($operacao=='edita')
	        <h6> Sua requisição foi salva com sucesso.     
        @else
        	<h6> Sua requisição foi realizada com sucesso.
        @endif @endisset 
        	<br>Ao retirar seus materiais poderá ser necessário informar o número da sua requisição. Anote: </h6>
         	<h4>Número: <span id='id_codRequisicaoModal'>ERRO</span></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-success" data-dismiss="modal" id='id_btn_close_modal' onclick='window.location.reload();'>Fechar</button>
      </div>
    </div>
  </div>
</div>


@push('scripts')
   	<script>
   		var arrayMateriaisRequisicao = [];
   		var cod_requisicao = 0;

   		@isset($operacao) @if($operacao=='edita')
		   		cod_requisicao = "{{$requisicao->cod_requisicao}}";
		   		document.getElementById('legend_num_req_id').innerHTML = "{{$requisicao->cod_requisicao}}";

		        var xhttp = new XMLHttpRequest();
		        xhttp.onreadystatechange = function() {
		        	if (this.readyState == 4 && this.status == 200) {
			          	var materiaisRequisitados = JSON.parse(this.responseText);
			          	for (m in materiaisRequisitados ) {
			          		arrayMateriaisRequisicao.push(materiaisRequisitados[m]);
		        			atualizaLista();
			          	};  
			          	
		          	}
		        };
		        xhttp.open("GET", "/minhas-requisicoes/localizaMateriaisRequisitados/" + cod_requisicao , true);
		        xhttp.send();
	   	@endif @endisset   





    	function localizarEstocados() {
	      	var meuObj = new Object();
	      	meuObj.nome_material = document.getElementById('nome_material').value;
	     	meuObj.cod_tipo = document.getElementById('cod_tipo').value;
			var meuJSON = JSON.stringify(meuObj);
	        var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
		          	var myObj = JSON.parse(this.responseText);
		          	var listagemRequisitar = document.getElementById('listagemEstoque');
		          	listagemRequisitar.innerHTML = '';
		          	for (m in myObj ) {
		          		var linha = listagemRequisitar.insertRow();
		          		linha.insertCell(0).innerHTML = myObj[m].nome_material;
		          		linha.insertCell(1).innerHTML = myObj[m].nome_tipo;
		          		linha.insertCell(2).innerHTML = myObj[m].total;
		          		linha.insertCell(3).innerHTML = myObj[m].descricao_unid_medida;
		          		let btnAdd = document.createElement('button');
		          		btnAdd.className = "btn btn-link";
		          		btnAdd.innerHTML = '<i class="fas fa-level-down-alt"> </i>';
		          		btnAdd.id = 'btn_material_add_id_' + m;
		          		btnAdd.type = "button";
		          		btnAdd.onclick = function() {
		          			let id = this.id.replace('btn_material_add_id_', '');
		          			add( myObj[id] );
		          			atualizaLista();
		          		};
		          		linha.insertCell(4).append(btnAdd);
		          	};  
	          	}
	        };
	        xhttp.open("GET", "/requisicao/localizaEstocados/" + meuJSON , true);
	        xhttp.send();
	    }   

    
	    function add( objMaterialRec ) {
	    	const objMaterial = Object.assign({}, objMaterialRec);
	    	//delete objMaterial.total; 
	    	
	    	//antes de adicionar no array, verificar se o material já não está lá!
	    	var matRepetido = false;

	    	arrayMateriaisRequisicao.forEach( function(mat) {
	    		if(mat.cod_material == objMaterial.cod_material ){
	    			matRepetido = true;
	    		}

	    	});

	    	if (matRepetido == false) {
	    		objMaterial.quantidade_req = 1;
	    		arrayMateriaisRequisicao.push(objMaterial);
	    	}
	   	}



		function valida () {
   			var valido = true;
   			arrayMateriaisRequisicao.forEach(function(mr){
   					if(isNaN(mr.quantidade_req) || mr.quantidade_req<1 ) {
   						valido = false;
   					}
   				});

   			return valido;
   		}



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
	      			if( ! isNaN(input.value)) {
	      				arrayMateriaisRequisicao[id].quantidade_req = input.value;
	      				input.className = '';
	      			}else{
	      				arrayMateriaisRequisicao[id].quantidade_req = 0;
	      				input.className = 'bg-danger';
	      			}

	      			if(valida() == true ){
	   					document.getElementById('btn_requisitar').disabled = false;
	   				} else {
	   					document.getElementById('btn_requisitar').disabled = true;
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



	   		if(document.getElementById('btn_requisitar')) {
	   			if (arrayMateriaisRequisicao.length > 0) {
	   					if(valida()==true ){
	   						document.getElementById('btn_requisitar').disabled = false;
	   					}	   				
		   		}
		   		else{
		   			document.getElementById('btn_requisitar').disabled = true;
		   		}

	   		}
	   		
	   	}

   		


	    function remove( objMaterialRec ) {

	    	arrayMateriaisRequisicao = arrayMateriaisRequisicao.filter(function(material){
		       return material.cod_material != objMaterialRec.cod_material;
		   	});
	   	}



	   	function requisitar() {
	   		var jsonMateriais = JSON.stringify(arrayMateriaisRequisicao);

	   		var xhttp = new XMLHttpRequest();

	        xhttp.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) 
	        	{
	        		document.getElementById('id_codRequisicaoModal').innerHTML = this.responseText;
	        		$('#protocoloModal').modal('show');	
		        }
		        else
		        	if (this.readyState == 4 && this.status != 200)
				        {
				        	document.getElementById('id_Modal_msg').innerHTML = '<h6>Erro ao tentar salvar uma requisição. Tente novamente mais tarde.<h6>' ;
				        	document.getElementById('protocoloModalLabel').innerHTML = 'Erro ao Requisitar';
				        	document.getElementById('protocoloModalLabel').className = 'text-danger';
				        	document.getElementById('id_btn_close_modal').className = 'btn btn-lg btn-danger';
			        		$('#protocoloModal').modal('show');

			          	}
	        };

	        xhttp.open("GET", "/requisicao/requisita/" + cod_requisicao + "/" + jsonMateriais , true);
	        xhttp.send();

	   	}


	</script>
@endpush

@endsection
