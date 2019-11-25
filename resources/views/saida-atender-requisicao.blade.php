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
				<div class="col-md-12" style="max-height: 500px; overflow-y: scroll;" id="lista_materias_com_estoques_id">


				</div>
			</div>

			<div class="form-row mt-2">
				<div class="col-12 d-flex justify-content-around" id="">
	    			<button type="button" class="btn btn-lg btn-success col-3" onclick="finalizar();"><i class="fas fa-check  mr-2"></i>Finalizar</button>
					<button type="button" class="btn btn-lg btn-success col-3" onclick="window.location.href='/saida';" > <i class="fas fa-ban mr-2"></i>Cancelar</button>
				</div>
			</div>
	</form>

</div>


	
</div>



@push('scripts')
   	<script>

   		var arrayMateriaisRequisicaoOriginal = [];
   		var arrayMateriaisRequisicao = [];
   		var cod_requisicao = 0;

   		cod_requisicao = "{{$requisicao->cod_requisicao}}";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
	          	arrayMateriaisRequisicaoOriginal = JSON.parse(this.responseText);
	          	arrayMateriaisRequisicao = JSON.parse(this.responseText);
	          	arrayMateriaisRequisicao.forEach(function(m){
	          		m['material']['estoques'].forEach(function(e){
	          				e.qtdeSaida = 0;
	          		});

	          	});
	          	atualizaLista();	          	
          	}        	
        };
        xhttp.open("GET", "/saida/localizaMateriaisRequisitadosComEstoques/" + cod_requisicao , true);
        xhttp.send();

		function atualizaLista() {
	   		var listagem = document.getElementById('lista_materias_com_estoques_id');
	      	listagem.innerHTML = '';
	      	for (m in arrayMateriaisRequisicao ) {
	      		var table = document.createElement("table");
			    table.className ="table table-sm table-bordered table-hover";
			    table.style = "text-align: center;";
			    var thead = document.createElement("thead");
			    var tbody = document.createElement("tbody");
			    tbody.id = "listagemRequisicao";

			    var headRow1 = document.createElement("tr");
				    var th1=document.createElement("th");
				    th1.className = 'thmaster bg-success';
				    th1.colSpan = '4';
				    var tituloTabela1 = document.createTextNode(arrayMateriaisRequisicao[m]['material'].nome_material );

				    th1.appendChild(tituloTabela1);
				    headRow1.appendChild(th1);  

				   	var th2=document.createElement("th");
				    th2.className = 'thmaster bg-success';
				    th2.colSpan = '2';
				    var tituloTabela2 = document.createTextNode('Requ. ' +arrayMateriaisRequisicao[m].quantidade_req  + ' '
				    										+ arrayMateriaisRequisicao[m]['material']['unidade'].descricao_unid_medida);

				    th2.appendChild(tituloTabela2);
				    headRow1.appendChild(th2);

			    thead.appendChild(headRow1);

			    var headRow2 = document.createElement("tr");

			    ["Local","Lote","Validade","Disp.","Qtde"].forEach(function(el) {
					var th=document.createElement("th");
					th.style = 'width: 20%; ';
					th.appendChild(document.createTextNode(el));
					headRow2.appendChild(th);
			    });
			    var th3=document.createElement("th");
	      			th3.rowSpan = 2
	      			th3.style = "width: 10%; vertical-align: middle; text-align: middle; margin: 0px; padding: 0px;"
					let btnReset = document.createElement('button');
	          		btnReset.className = "btn btn-link p-0 m-0";
	          		btnReset.innerHTML = '<i class="fas fa-redo m-0 p-0"> </i>';
	          		btnReset.id = 'btnReset_material_id_' + m;
	          		btnReset.type = "button";
	          		btnReset.onclick = function() {
	          			let id = this.id.replace('btnReset_material_id_', '');
	      				//limpando os estocados para reiniciar
						do
						   arrayMateriaisRequisicao[id]['material']['estoques'].pop();
						while (arrayMateriaisRequisicao[id]['material']['estoques'].length > 0);

						//recarregando os estocados	          			
						arrayMateriaisRequisicaoOriginal[id]['material']['estoques'].forEach(function(e){
							const estocado = Object.assign({}, e);	
							estocado.qtdeSaida = 0;					
							if(arrayMateriaisRequisicaoOriginal[id]['material'].cod_material == arrayMateriaisRequisicao[id]['material'].cod_material) {
								arrayMateriaisRequisicao[id]['material']['estoques'].push(estocado);
							}
					
			    		});

	      				atualizaLista();
	          		};


	          		th3.appendChild(btnReset);
					headRow2.appendChild(th3);

			    thead.appendChild(headRow2);
			    table.appendChild(thead); 

				for (e in arrayMateriaisRequisicao[m]['material']['estoques']) {		
					var linha = document.createElement("tr");
	          		linha.insertCell(0).innerHTML = arrayMateriaisRequisicao[m]['material']['estoques'][e]['local'].nome_local;
	          		linha.insertCell(1).innerHTML = arrayMateriaisRequisicao[m]['material']['estoques'][e].lote;
	          		linha.insertCell(2).innerHTML = arrayMateriaisRequisicao[m]['material']['estoques'][e].get_data_atend_formatada;
	          		linha.insertCell(3).innerHTML = arrayMateriaisRequisicao[m]['material']['estoques'][e].quantidade;
	          		let input = document.createElement('input');
		      		input.type = 'text';
		      		input.value = arrayMateriaisRequisicao[m]['material']['estoques'][e].qtdeSaida;;
		      		input.id = 'input_quantidade_id_' + arrayMateriaisRequisicao[m]['material']['estoques'][e].id;;
		      		input.placeholder = 'digite qtde...';
		      		input.onkeyup = function() {
		      			let id_estoque = this.id.replace('input_quantidade_id_', '');
		      			if( ! isNaN(input.value) ) {
		      				for (m in arrayMateriaisRequisicao ) {
		      					for (e in arrayMateriaisRequisicao[m]['material']['estoques'] ) {
		      						if(arrayMateriaisRequisicao[m]['material']['estoques'][e].id == id_estoque){
		      							arrayMateriaisRequisicao[m]['material']['estoques'][e].qtdeSaida = input.value;
		      							input.className = '';
		      						}
		      					}
		      				}		      				
		      			}else{
		      				input.className = 'bg-danger';
		      			} 		
		      		};
			      	linha.insertCell(4).append(input);
	          		let btn = document.createElement('button');
	          		btn.className = "btn btn-link";
	          		btn.innerHTML = '<i class="fas fa-times text-danger"> </i>';
	          		btn.id = 'btn_material_id_' + arrayMateriaisRequisicao[m]['material']['estoques'][e].id;
	          		btn.type = "button";
	          		btn.onclick = function() {
	          			let estoque_id = this.id.replace('btn_material_id_', '');
	          			remove(estoque_id);
	      				atualizaLista();
	          		};
	          		linha.insertCell(5).append(btn);
					tbody.appendChild(linha);
				}

				table.appendChild(tbody);
				listagem.appendChild(table);
	   		}
	   	}

	   	function remove( estoque_id ) {
	   		for (m in arrayMateriaisRequisicao ) {
		   		arrayMateriaisRequisicao[m]['material']['estoques'] = arrayMateriaisRequisicao[m]['material']['estoques'].filter(function(estoque){
			       	return estoque.id != estoque_id;
			   	});	
	   		}
	   	}


	   	function finalizar () {
	   		console.log(arrayMateriaisRequisicao);
	   		var jsonSaida = JSON.stringify(arrayMateriaisRequisicao);

	   		var xhttp = new XMLHttpRequest();

	        xhttp.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
	        		console.log('bem sucedido');
	        		console.log(this.responseText);
	        		// document.getElementById('id_codRequisicaoModal').innerHTML = this.responseText;
	        		// $('#protocoloModal').modal('show');	
		        } else if (this.readyState == 4 && this.status != 200) {
		        	console.log('erro');
		        	// document.getElementById('id_Modal_msg').innerHTML = '<h6>Erro ao tentar salvar uma requisição. Tente novamente mais tarde.<h6>' ;
		        	// document.getElementById('protocoloModalLabel').innerHTML = 'Erro ao Requisitar';
		        	// document.getElementById('protocoloModalLabel').className = 'text-danger';
		        	// document.getElementById('id_btn_close_modal').className = 'btn btn-lg btn-danger';
	        		// $('#protocoloModal').modal('show');

	          	}
	        };

	        xhttp.open("GET", "/saida/requisita/" + cod_requisicao + "/" + jsonSaida , true);
	        xhttp.send();

	   	}

	</script>
@endpush

@endsection





