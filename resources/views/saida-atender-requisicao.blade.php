@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">

<form class="">

	<div class="form-row d-flex align-items-end">

		<div class="col-md-3 form-group">
          <label >Número Requisição</label>
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
	    			<button type="button" class="btn btn-lg btn-success col-3" onclick="finalizar();" id="btn_finalizar" disabled><i class="fas fa-check  mr-2"  ></i>Finalizar</button>
					<button type="button" class="btn btn-lg btn-success col-3" onclick="window.location.href='/saida';" > <i class="fas fa-ban mr-2"></i>Cancelar</button>
				</div>
			</div>
	</form>

</div>


	
</div>





<!-- Modal finalização-->
<div class="modal fade" id="finalizaModal" tabindex="-1" role="dialog" aria-labelledby="finalizaModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="finalizaModalLabel"> título do modal </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
	        <h6 id='id_Modal_msg'> mensagem </h6>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-success" data-dismiss="modal" id='id_btn_close_modal' >Fechar</button>
      </div>
    </div>
  </div>
</div>






@push('scripts')
   	<script>

   		var requisicaoOriginal = [];
   		var requisicao = [];
   		var cod_requisicao = 0;

   		cod_requisicao = "{{$requisicao->cod_requisicao}}";

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        	if (this.readyState == 4 && this.status == 200) {
	          	requisicaoOriginal = JSON.parse(this.responseText);
	          	requisicao = JSON.parse(this.responseText);
	          	requisicao['materiais_requisitados'].forEach(function(m){
	          		m['material']['estoques'].forEach(function(e){
	          				e.qtdeSaida = 0;
	          		});

	          	});
	          	atualizaLista();	          	
          	}        	
        };
        xhttp.open("GET", "/saida/localizaMateriaisRequisitadosComEstoques/" + cod_requisicao , true);
        xhttp.send();


        function valida () {
   			var valido = true;

   			var total = 0;
   			var totalMaterial = 0;

   			requisicao.materiais_requisitados.forEach(function(m){
   				totalMaterial = 0;
          		m.material.estoques.forEach(function(e) {
          			//if(e.qtdeSaida){ //se existe a propriedade
          				if(isNaN(e.qtdeSaida) || e.qtdeSaida < 0 ) {
							valido = false;
						}else{
							totalMaterial = Number(totalMaterial) + Number(e.qtdeSaida);
          					total = Number(total) + Number(e.qtdeSaida);
						}	          			
          		//	}          			
          		});
          		//dando saida em um qtde maior do que a requisitada para  mterial?
	   			if(totalMaterial > m.quantidade_req){
	   				valido = false;
	   			}
	         });

   			//não vai dar saida em nada?
   			if(total <= 0 ){
   				valido = false;
   			}

   			return valido;	
   		}


		function atualizaLista() {
	   		var listagem = document.getElementById('lista_materias_com_estoques_id');
	      	listagem.innerHTML = '';
	      	for (m in requisicao['materiais_requisitados'] ) {
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
				    var tituloTabela1 = document.createTextNode(requisicao['materiais_requisitados'][m]['material'].nome_material );

				    th1.appendChild(tituloTabela1);
				    headRow1.appendChild(th1);  

				   	var th2=document.createElement("th");
				    th2.className = 'thmaster bg-success';
				    th2.colSpan = '2';
				    var tituloTabela2 = document.createTextNode('Requ. ' +requisicao['materiais_requisitados'][m].quantidade_req  + ' '
				    										+ requisicao['materiais_requisitados'][m]['material']['unidade'].descricao_unid_medida);

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
						   requisicao['materiais_requisitados'][id]['material']['estoques'].pop();
						while (requisicao['materiais_requisitados'][id]['material']['estoques'].length > 0);

						//recarregando os estocados	          			
						requisicaoOriginal['materiais_requisitados'][id]['material']['estoques'].forEach(function(e){
							const estocado = Object.assign({}, e);	
							estocado.qtdeSaida = 0;					
							if(requisicaoOriginal['materiais_requisitados'][id]['material'].cod_material == requisicao['materiais_requisitados'][id]['material'].cod_material) {
								requisicao['materiais_requisitados'][id]['material']['estoques'].push(estocado);
							}
					
			    		});

	      				atualizaLista();
	          		};


	          		th3.appendChild(btnReset);
					headRow2.appendChild(th3);

			    thead.appendChild(headRow2);
			    table.appendChild(thead); 




			    if(requisicao['materiais_requisitados'][m]['material']['calcQtdeTotal'] <= 0){
			    	var linha=document.createElement("tr");
			    	var col=document.createElement("td");
				    col.className = 'text-danger';
				    col.colSpan = '6';
				    var conteudo = document.createTextNode("Material Indisponível");
				    col.appendChild(conteudo);
				    linha.appendChild(col);
				    tbody.appendChild(linha);

			    } else {
			    	for (e in requisicao['materiais_requisitados'][m]['material']['estoques']) {
						if(requisicao['materiais_requisitados'][m]['material']['estoques'][e].quantidade > 0) {
							var linha = document.createElement("tr");
			          		linha.insertCell(0).innerHTML = requisicao['materiais_requisitados'][m]['material']['estoques'][e]['local'].nome_local;
			          		linha.insertCell(1).innerHTML = requisicao['materiais_requisitados'][m]['material']['estoques'][e].lote;
			          		linha.insertCell(2).innerHTML = requisicao['materiais_requisitados'][m]['material']['estoques'][e].get_data_atend_formatada;
			          		linha.insertCell(3).innerHTML = requisicao['materiais_requisitados'][m]['material']['estoques'][e].quantidade;
			          		let input = document.createElement('input');
				      		input.type = 'text';
				      		input.value = requisicao['materiais_requisitados'][m]['material']['estoques'][e].qtdeSaida;;
				      		input.id = 'input_quantidade_id_' + requisicao['materiais_requisitados'][m]['material']['estoques'][e].id;;
				      		input.placeholder = 'digite qtde...';
				      		input.onkeyup = function() {
				      			let id_estoque = this.id.replace('input_quantidade_id_', '');
				      			
				      				for (m in requisicao['materiais_requisitados'] ) {
				      					for (e in requisicao['materiais_requisitados'][m]['material']['estoques'] ) {
				      						if(requisicao['materiais_requisitados'][m]['material']['estoques'][e].id == id_estoque){
				      							if(input.value == ''){
				      								requisicao['materiais_requisitados'][m]['material']['estoques'][e].qtdeSaida = 0;			      				
								      			} else {
				      								requisicao['materiais_requisitados'][m]['material']['estoques'][e].qtdeSaida = input.value;
								      		
					      							if( ! isNaN(input.value) ) {
					      								input.className = '';
					      							}else{
									      				input.className = 'bg-danger';
									      				//requisicao['materiais_requisitados'][m]['material']['estoques'][e].qtdeSaida = 0;
								      				}
								      			}
							      				
				      						}
				      					}
				      				}		      				
				      			 

					      		if(valida() == true ){
				   					document.getElementById('btn_finalizar').disabled = false;
				   				} else {
				   					document.getElementById('btn_finalizar').disabled = true;
				   				}


				      		};
					      	linha.insertCell(4).append(input);
			          		let btn = document.createElement('button');
			          		btn.className = "btn btn-link";
			          		btn.innerHTML = '<i class="fas fa-times text-danger"> </i>';
			          		btn.id = 'btn_material_id_' + requisicao['materiais_requisitados'][m]['material']['estoques'][e].id;
			          		btn.type = "button";
			          		btn.onclick = function() {
			          			let estoque_id = this.id.replace('btn_material_id_', '');
			          			remove(estoque_id);
			      				atualizaLista();
			          		};
			          		linha.insertCell(5).append(btn);
							tbody.appendChild(linha);
						}

					}		

			    }

				table.appendChild(tbody);
				listagem.appendChild(table);
	   		}

	   	}

	   	function remove( estoque_id ) {
	   		for (m in requisicao['materiais_requisitados'] ) {
		   		requisicao['materiais_requisitados'][m]['material']['estoques'] = requisicao['materiais_requisitados'][m]['material']['estoques'].filter(function(estoque){
			       	return estoque.id != estoque_id;
			   	});	
	   		}
	   	}

	   	var openPageAnterior = function openPage(){
	   		window.location.assign('/saida');
	   	}

	   	function exibeModal(resp){	   		
			document.getElementById('finalizaModalLabel').innerHTML = resp.status;
			document.getElementById('id_Modal_msg').innerHTML = resp.msg;
			if(resp.status == 'Sucesso'){	        		
	    		document.getElementById('finalizaModalLabel').className = 'text-success';
	    		document.getElementById('id_btn_close_modal').className = 'btn btn-lg btn-success';
	    		document.getElementById('id_btn_close_modal').addEventListener("click", openPageAnterior, false);
	    		
			} else {
	    		document.getElementById('finalizaModalLabel').className = 'text-danger';
	    		document.getElementById('id_btn_close_modal').className = 'btn btn-lg btn-danger';
			}	        		
			$('#finalizaModal').modal('show');

	   	}

	   	function finalizar () {

	   		var jsonRequisicaoAtendida = JSON.stringify(requisicao);
	   		var xhttp = new XMLHttpRequest();
	        xhttp.onreadystatechange = function() {
	        	if (this.readyState == 4 && this.status == 200) {
	        		var resp = JSON.parse(this.responseText);
	        		exibeModal(resp);
		        } else if (this.readyState == 4 && this.status != 200) {
		        	var resp = {status : 'Erro', msg :'Erro inesperado relacionado ao servidor!' };
		        	exibeModal(resp); 
	          	}
	        };
	        xhttp.open("POST",  "/saida/finaliza" , true);
			xhttp.setRequestHeader("Content-Type", "application/json");
			token = document.querySelector('meta[name="csrf-token"]').content;
			xhttp.setRequestHeader('X-CSRF-TOKEN', token);						
			xhttp.send(jsonRequisicaoAtendida);
	   	}
	</script>
@endpush

@endsection





