@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">

	<form class="">
		<fieldset class="border shadow-sm p-3">
			<legend>Estoque:</legend>

			<div class="form-row d-flex align-items-end">

			    <div class="col-sm-12 col-md-5 form-group">
			      <label for="inputEmail4">Desc. Material</label>
			      <input type="text" class="form-control" id="inputEmail4" placeholder="Parte da descrição de um material">
			    </div>

			   	<div class="col-sm-8 col-md-4 form-group">
			      <label for="inputState">Tipo</label>
			      <select id="inputState" class="form-control">
			        <option selected>EPI</option>
			        <option>Escritório</option>
			      </select>
			    </div>

			    <div class="form-group col-sm-4 col-md-3">
			    	<button type="submit" class="btn btn-success" style="width: 100%;"><i class="fas fa-search  mr-2"></i>Localizar</button>
				</div>
				<input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
		 	</div>


			<div class="form-row">
				<div class="col-md-12" style="height: 160px; overflow-y: scroll;" ><!--inicio da listagem de materiais-->
					<table class="table table-sm table-bordered table-hover " style="text-align: center;">
						<tr>
							<th style="width: 50%;" >Material</th>
							<th style="width: 20%;" >Tipo</th>
							<th style="width: 15%;" >Disponivel</th>
							<th style="width: 10%;" >Unid.</th>						
							<th style="width: 5%;" > </th>
						</tr>
						<tr>
							<td style="text-align: left;" > Camiseta Branca tam. M</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td  style="text-align: left;" > Calça Bege tam. 42</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 43</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 44</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 45</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 46</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 47</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 42</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 42</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;"  > Calça Bege tam. 42</td>
							<td                            > EPI </td>
							<td                            > 35 </td>
							<td                            > pçs </td>
							<td                            > <a href="/requisicao/edita/1"> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
					</table>
				</div><!--fim da listagem de locais-->
			</div>
		</fieldset>

	</form>


	<form class="mt-4">
		<fieldset class="border shadow-sm p-3">
		<legend>Requição: <strong>Nova</strong> </legend>
			<div class="form-row">
				<div class="col-md-12" style="height: 160px; overflow-y: scroll;" ><!--inicio da listagem de materiais-->
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
							<td style="text-align: left;" > Camiseta Branca tam. M</td>
							<td > EPI </td>
							<td > <input type="text" name="" value="" placeholder="digite qtde..." class="p-0 m-0" style="width: 100%;" />  </td>
							<td > pçs </td>
							<td > <a href="/requisicao/edita/1"> <span class="fas fa-level-up-alt"> </span> </a> </td>
						</tr>
						<tr scope="row">
							<td style="text-align: left;"> Calça Uniforme Eletricista tam. 44</td>
							<td > EPI </td>
							<td > <input type="text" name="" value="" placeholder="digite qtde..." class="p-0 m-0" style="width: 100%;" />  </td>
							<td > pçs </td>
							<td > <a href="/requisicao/edita/1"> <span class="fas fa-level-up-alt"> </span> </a> </td>
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



@endsection
