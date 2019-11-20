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
			<div class="form-row">
				<div class="col-md-12" style="height: 500px; overflow-y: scroll;" ><!--inicio da listagem de materiais-->
					<table class="table table-sm table-bordered table-hover " style="text-align: center; border-color: green;" >

						<tr>
							<th class="thmaster" colspan="6" > Parafuso Allen sem Cabeça M12x25 - 44 pçs</th>
						</tr>
							<th style="width: 15%;" >Local </th>
							<th style="width: 15%;" >Disp</th>
							<th style="width: 15%;" >Lote</th>
							<th style="width: 15%;" >Validade</th>
							<th style="width: 15%;" >Qtde</th>	
							<th style="width: 5%;"  > </th>													
						</tr>
							<tr>
								<td> A345 </td>
								<td> 100 </td>
								<td> 4837 </td>
								<td> 25/11/2019 </td>
								<td> <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" />  </td>	
								<td style="text-align: center;"> <a href="/essdfdsftoque/ajusta/66666"> <span class="fas fa-times text-danger"></span> </a> </td>						
							</tr >
							<tr>
								<td> U345 </td>
								<td> 130 </td>
								<td> 968547 </td>
								<td> 30/12/2019 </td>
								<td > <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" />  </td>	
								<td style="text-align: center;"> <a href="/sidsfdsf/ajusta/6666"> <span class="fas fa-times text-danger" > </span> </a> </td>		
							</tr>			
					</table>





					<table class="table table-sm table-bordered table-hover " style="text-align: center; border-color: green;" >

						<tr>
							<th class="thmaster" colspan="6" > Macacão Eletricista tamanho GG - 2 pçs</th>
						</tr>
							<th style="width: 15%;" >Local </th>
							<th style="width: 15%;" >Disp</th>
							<th style="width: 15%;" >Lote</th>
							<th style="width: 15%;" >Validade</th>
							<th style="width: 15%;" >Qtde</th>	
							<th style="width: 5%;"  > </th>													
						</tr>
							<tr>
								<td> A345 </td>
								<td> 44 </td>
								<td> 09674 </td>
								<td>   </td>
								<td> <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" />  </td>	
								<td style="text-align: center;"> <a href="/essdfdsftoque/ajusta/66666"> <span class="fas fa-times text-danger"></span> </a> </td>						
							</tr >
							<tr>
								<td> U345 </td>
								<td> 68 </td>
								<td> 099837 </td>
								<td>  </td>
								<td > <input type="text" name="" value="" class="p-0 m-0" style="width: 100%;" />  </td>	
								<td style="text-align: center;"> <a href="/sidsfdsf/ajusta/6666"> <span class="fas fa-times text-danger" > </span> </a> </td>		
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


	
</div>


@endsection
