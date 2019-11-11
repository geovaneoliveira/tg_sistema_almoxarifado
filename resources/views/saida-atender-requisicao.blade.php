@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">

<form class="">

	<div class="form-row d-flex align-items-end">

		<div class="col-md-3 form-group">
          <label for="">Número Requição </label>
          <input type="text" value="859847" class="form-control" id="" readonly />
        </div>

		<div class="col-md-6 form-group">
          <label for="">Nome do Requisitante</label>
          <input type="text" value="Girafales Valdez" class="form-control" id="" readonly />
        </div>

        <div class="col-md-3 form-group" readonly>
            <label for="">Data de Requisição</label>
            <div class="input-group" readonly>
              <input type="date" value="2019-10-25" class="form-control" id="" readonly> 
            </div>            
        </div>                  

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

</form>


<div class="row">
	<form class="col-md-12">
		<fieldset class="border shadow-sm p-3">
			<legend>Requisicao:</legend>
			<div class="form-row">
				<div class="col-md-12" style="height: 200px; overflow-y: scroll;" ><!--inicio da listagem de materiais-->
					<table class="table table-sm table-bordered table-hover " style="text-align: center;">
						<tr >
							<th class="thmaster" colspan="4" >Requisitado</th>
							<th class="thmaster" colspan="3" >Local de Origem</th>
						</tr>
						<tr>
							<th style="" >Material</th>
							<th style="" >Tipo</th>
							<th style="" >Qtde Req.</th>
							<th style="" >Unid.</th>
							<th style="" >Local / Disp.</th>
							<th style="width: 10%;" >Qtde</th>													
							<th style="" > </th>
						</tr>
						<tr>
							<td style="text-align: left;" > Parafuso Allen sem Cabeça M12x25</td>
							<td> Insumos </td>
							<td> 44 </td>
							<td> pçs </td>
							<td class="input-group">
								<select  id="cod_tipo" name="cod_tipo"  style="width: 100%; height: 100%; ">
					              <option value="1"> A345 / 45 </option>
					              <option value="2"> J764 / 345 </option>
					              <option value="3"> K987 / 478 </option>
					            </select>
							</td>
							<td > <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" />  </td>
							<td> <a href=""> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;" > Porca Sext. DIN 916 M12x25</td>
							<td> Insumos </td>
							<td> 50 </td>
							<td> pçs </td>
							<td class="input-group">
								<select class="" id="cod_tipo" name="cod_tipo" style="width: 100%; height: 100%;">
					              <option value="1"> A345 / 45 </option>
					              <option value="2"> J764 / 345 </option>
					              <option value="3"> K987 / 478 </option>
					            </select>
							</td>
							<td > <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" />  </td>
							<td> <a href=""> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
					</table>
				</div><!--fim da listagem de locais-->
			</div>
		</fieldset>

	</form>

<!---
<form class="col-md-5">
		<fieldset class="border shadow-sm p-3">
			<legend>Local:</legend>
			<div class="form-row">
				<div class="col-md-12" style="height: 160px; overflow-y: scroll;" >
					<table class="table table-sm table-bordered table-hover " style="text-align: center;">
						<tr>
							<th style="width: 30%;">Local</th>
							<th style="width: 30%;">Disp.</th>
							<th style="width: 35%;">Qtde</th>					
							<th style="width: 5%;" > </th>
						</tr>
						<tr>
							<td > M567</td>
							<td > 45 </td>
							<td > <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" /> </td>
							<td > <a href=""> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td > H654</td>
							<td > 300 </td>
							<td > <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" /> </td>
							<td > <a href=""> <span class="fas fa-level-down-alt"> </span> </a> </td>
						</tr>
					</table>
				</div>
			</div>
		</fieldset>

	</form>
-->

</div>




	<form class="mt-2">
		<fieldset class="border shadow-sm p-3">
		<legend>Saída:</legend>
			<div class="form-row">
				<div class="col-md-12" style="height: 200px; overflow-y: scroll;" ><!--inicio da listagem de materiais-->

					<table class="table table-sm table-bordered table-hover " style="text-align: center;">
						<tr >
							<th class="thmaster" colspan="4" >Requisitado</th>
							<th class="thmaster" colspan="3" >Local de Origem</th>
						</tr>
						<tr>
							<th style="" >Material</th>
							<th style="" >Tipo</th>
							<th style="" >Qtde Req.</th>
							<th style="" >Unid.</th>
							<th style="" >Local / Disp.</th>
							<th style="width: 10%;" >Qtde</th>													
							<th style="" > </th>
						</tr>
						<tr>
							<td style="text-align: left;" > Parafuso Allen sem Cabeça M12x25</td>
							<td> Insumos </td>
							<td> 44 </td>
							<td> pçs </td>
							<td> A345 / 45 </td>
							<td> 44 </td>
							<td> <a href=""> <span class="fas fa-level-up-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;" > Porca Sext. DIN 916 M12x25</td>
							<td> Insumos </td>
							<td> 50 </td>
							<td> pçs </td>
							<td> A345 / 45 </td>
							<td > 30 </td>
							<td> <a href=""> <span class="fas fa-level-up-alt"> </span> </a> </td>
						</tr>
						<tr>
							<td style="text-align: left;" > Porca Sext. DIN 916 M12x25</td>
							<td> Insumos </td>
							<td> 50 </td>
							<td> pçs </td>
							<td> A345 / 45 </td>
							<td > 20 </td>
							<td> <a href=""> <span class="fas fa-level-up-alt"> </span> </a> </td>
						</tr>
					</table>

				</div><!--fim da listagem de locais-->
			</div>




			<div class="form-row mt-2">
				<div class="col-12 d-flex justify-content-around" id="">
	    			<button type="button" class="btn btn-lg btn-success" ><i class="fas fa-check  mr-2"></i>Finalizar</button>
					<button type="button" class="btn btn-lg btn-success" onclick="window.location.href='/saida';" > <i class="fas fa-ban mr-2"></i>Cancelar</button>
				</div>
			</div>
		</fieldset>
	</form>



	
</div>


@endsection
