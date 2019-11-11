@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">

<form class="mt-4">

	<div class="form-row d-flex align-items-end">

		<div class="col-md-4 form-group">
          <label for="">Número Requição </label>
          <input type="text" value="859847" class="form-control" id="" readonly />
        </div>

		<div class="col-md-8 form-group">
          <label for="">Nome do Requisitante</label>
          <input type="text" value="Girafales Valdez" class="form-control" id="" readonly />
        </div>

        <div class="col-md-4 form-group">
          <label for="">Situacão</label>
          <input type="text" value="Finalizada" class="form-control" id="" readonly />
        </div>

        <div class="col-md-4 form-group" readonly>
            <label for="">Data de Requisição</label>
            <div class="input-group" readonly>
              <input type="date" value="2019-10-25" class="form-control" id="" readonly> 
            </div>            
        </div>  

        <div class="col-md-4 form-group">
            <label for="">Data de Finalização</label>
            <div class="input-group">           
              <input type="date" value="2019-10-25" class="form-control" id=""readonly >
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
					<tr scope="row">
						<td style="text-align: left;" > Camiseta Branca tam. M</td>
						<td > EPI </td>
						<td > 2 </td>
						<td > 2 </td>
						<td > pçs </td>
					</tr>
					<tr scope="row">
						<td style="text-align: left;"> Calça Uniforme Eletricista tam. 44</td>
						<td > EPI </td>
						<td > 2  </td>
						<td > 2  </td>
						<td > pçs </td>
					</tr>
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
