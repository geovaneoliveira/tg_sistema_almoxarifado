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
						<tbody id="listagemRequisitar">
						</tbody>
					</table>
				</div>
			</div>

		</fieldset>

	</form>


	<form class="mt-4">
		<fieldset class="border shadow-sm p-3">
		<legend>Requição: <strong>Nova</strong> </legend>
			<div class="form-row">
				<div class="col-md-12" style="height: 170px; overflow-y: scroll;" ><!--inicio da listagem de materiais-->
					<table class="table table-sm table-bordered table-hover " style="text-align: center;">
						<thead>
							<tr scope="row">
								<th style="width: 50%;" >Material</th>
								<th style="width: 20%;" >Tipo</th>
								<th style="width: 15%;" >Qtde.</th>
								<th style="width: 10%;" >Unid.</th>						
								<th style="width: 5%;" > </th>
							</tr>
						</thead>

	  					<tbody>
							<tr scope="row">
								<td >   </td>
								<td >   </td>
								<td > <input type="text" name="" value="" placeholder="digite qtde..." />  </td>
								<td > pçs </td>
								<td > <a href="/requisicao/edita/id"> <span class="fas fa-level-up-alt"> </span> </a> </td>
							</tr>
					</tbody>	
					</table>
				</div><!--fim da listagem de locais-->
			</div>




			<div class="form-row">
				<div class="col-12 d-flex justify-content-around" id="">
				@isset($operacao)
	    			@if($operacao=='edita')
	    				<button type="button" class="btn btn-lg btn-success" ><i class="far fa-save mr-2"></i>Salvar</button>
					@endif

					@if($operacao=='abreForm')
	    				<button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#protocoloModal" ><i class="fas fa-check  mr-2"></i>Requisitar</button>
					@endif
				@endisset
				<button type="button" class="btn btn-lg btn-success" onclick="window.location.href='/requisicao';" > <i class="fas fa-ban mr-2"></i>Cancelar</button>
				</div>
			</div>
		</fieldset>
	</form>
	
</div>


<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#protocoloModal">
  Launch demo modal
</button>
 -->

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
      <div class="modal-body">
        <h6> Sua requisição foi realizada com sucesso.
        Ao retirar seus materiais poderá ser necessário informar o número da sua requisição: </h6> 
        <h4>Número: 387 </h4>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-success" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>





@push('scripts')
   	<script>

      function localizarEstocados() {

      	var meuObj = new Object();
      	meuObj.nome_material = document.getElementById('nome_material').value;
     	meuObj.cod_tipo = document.getElementById('cod_tipo').value;
		var meuJSON = JSON.stringify(meuObj);

        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
	          	var myObj = JSON.parse(this.responseText);
	          	var listagemRequisitar = document.getElementById('listagemRequisitar');
	          	listagemRequisitar.innerHTML = '';
	          	console.log(myObj);
	          	for (m in myObj ) {
	          		console.log(myObj[m]);
	          		var linha = listagemRequisitar.insertRow();
	          		linha.insertCell(0).innerHTML = myObj[m].nome_material;
	          		linha.insertCell(1).innerHTML = myObj[m].nome_tipo;
	          		linha.insertCell(2).innerHTML = myObj[m].total;
	          		linha.insertCell(3).innerHTML = myObj[m].descricao_unid_medida;
	          		let btn = document.createElement('button');
	          		btn.className = "btn btn-link";
	          		btn.innerHTML = '<i class="fas fa-level-down-alt"> </i>';
	          		btn.id = 'btn_material_id_' + m;
	          		btn.type = "button";

	          		btn.onclick = function() {
	          			let id = this.id.replace('btn_material_id_', '');
	          			add( myObj[id] );
	          		}

	          		linha.insertCell(4).append(btn);
	          	};  

          	}
        };
        xhttp.open("GET", "/requisicao/localizaEstocados/" + meuJSON , true);
        xhttp.send();
    }

    var arrayMateriaisRequisicao = [];

    


    function add(objMaterialRec ){

    	//antes de adicionar no array, verificar se o material já não está lá!
    	arrayMateriaisRequisicao.push(objMaterialRec);
    	console.log(arrayMateriaisRequisicao);

    	//char uma função para carregar a tabela de acordo com o array

    	//pensar se vai dar um submit no form ou se vai enviar um json para incluir. Neste ultimo caso, como fariamos a validação do sucesso?
   	}

	</script>
@endpush

@endsection
