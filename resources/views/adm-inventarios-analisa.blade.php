@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="">

    <fieldset class="border shadow-sm p-3">
    <legend>Inconsistências:</legend>

    <div class="form-row d-flex align-items-end">

          <div class="col-sm-6 col-md-4  form-group">
            <label for="cod_tipo">Local</label>
            <div class="input-group">
              <select class="form-control" id="" name="">
                <option value=""> Todos </option>
                <option value="1"> D284 </option>
                <option value="2"> U896 </option>
                <option value="3"> P593 </option>
              </select>
            </div>
          </div>


          <div class="col-sm-6 col-md-4 form-group">
            <label for="cod_tipo">Tipo</label>
            <div class="input-group">
              <select class="form-control" id="" name="">
                <option value=""> Todas </option>
                <option value="1"> Lubrificantes </option>
                <option value="2"> EPIs </option>
                <option value="3"> Escritório </option>
              </select>
            </div>
          </div>

          <div class="col-sm-6 col-md-4  form-group">
            <label for="cod_tipo">Contagem</label>
            <div class="input-group">
              <select class="form-control" id="" name="">
                <option value=""> Não inventariados</option>
                <option value=""> Inventáriados </option>
                <option value=""> Todos </option>
              </select>
            </div>
          </div>

          <div class="col-sm-6 col-md-4 form-group ">
            <fieldset class="border p-2">
              <legend class=" m-0 p-0" style="font-size: 1em;">Situação</legend>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                <label class="form-check-label" for="defaultCheck1">
                  Avaliados
              </div>

              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="defaultCheck2">
                <label class="form-check-label" for="defaultCheck2">
                  Não Avaliados
              </div>

            </fieldset>
          </div>

          <div class="col-sm-6 col-md-4 form-group">
            <label for="">Material</label>
            <input type="text" class="form-control" id="" placeholder="parte do nome do material">
          </div>

          <div class="col-sm-6 col-md-4 form-group">
            <label for="">Lote</label>
            <input type="text" class="form-control" id="" placeholder="parte núm. lote">
          </div>


          <div class="form-group col-sm-6 col-md-4 " >
                  <button type="submit" class="btn btn-success" style="width: 100%;"><i class="fas fa-search mr-2"></i>Localizar</button>
          </div>





      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


    <div class="form-row">
      <div class="col-md-12" style="max-height:400px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr>
            <th>Est.</th>
            <th>Material </th>
            <th>Lote </th>
            <th>Local</th>
            <th>Qtde </th>
            <th>Unid </th>
            <th>Contador </th>
            <th>Qtde </th>
            <th > <i class="fas fa-check-double " > </th>
          </tr>




          <tr>
            <td rowspan="4"> 541 </td>
            <td rowspan="4"> Porca Sextavada M8 DIN 934 </td>
            <td rowspan="4"> 2346762 </td>
            <td rowspan="4"> A673 </td>
            <td rowspan="4"> 132 </td>
            <td rowspan="4"> pçs </td>
          </tr>
          <tr>
              <td> Gustavo da Silva </td>
              <td> 131 </td>
              <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
          </tr>
          <tr>
            <td> Mariana Teixeira </td>
             <td> 132 </td>
            <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
          </tr>
          <tr>
            <td> Leticia Gonçaves</td>
            <td> 132 </td>
            <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
          </tr>




          <tr>
            <td rowspan="3"> 161 </td>
            <td rowspan="3"> Parafuso Allen Cabeça baixa M8 DIN 912 </td>
            <td rowspan="3"> 789762 </td>
            <td rowspan="3"> A673 </td>
            <td rowspan="3"> 157 </td>
            <td rowspan="3"> pçs </td>
          </tr>
          <tr>
              <td> Gustavo da Silva </td>
              <td> 157 </td>
              <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
          </tr>
          <tr>
            <td> Mariana Teixeira </td>
             <td> 156 </td>
            <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
          </tr>




          <tr>
            <td rowspan="3"> ´162 </td>
            <td rowspan="3"> Parafuso Allen M10 DIN 912 </td>
            <td rowspan="3"> 789762 </td>
            <td rowspan="3"> A673 </td>
            <td rowspan="3"> 168 </td>
            <td rowspan="3"> pçs </td>
          </tr>
          <tr>
              <td> Girafales Veldez </td>
              <td> 167 </td>
              <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
          </tr>
          <tr>
            <td> Chespirito de Oliveira </td>
             <td> 168 </td>
            <td> <a href="#"> <span class="far fa-circle text-success">   </span> </a> </td>
          </tr>



        </table>
      </div><!--fim da listagem de locais-->
    </div>


</fieldset>

</form> <!-- fim do formulário-->






    <div class="row mt-4">
      <div class="col-12 d-flex justify-content-around" id="">
        <button type="button" class="btn btn-lg btn-warning col col-md-6" ><i class="fas fa-check-double  mr-2" > </i>Finalizar Inventário</button>
      </div>
    </div>



</div>


@endsection
