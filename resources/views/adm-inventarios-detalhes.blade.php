@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="">

    <div class="form-row d-flex align-items-end">

       <div class="col-sm-12 col-md-3 form-group">
          <label for="">Cód.</label>
          <input type="text" class="form-control" id="" value="234" readonly />
        </div>

        <div class="col-sm-12 col-md-6 form-group">
          <label for="">Responsável</label>
          <input type="text" class="form-control" id="" value="Geovane Viana" readonly />
        </div>

        <div class="col-sm-12 col-md-3 form-group">
            <label for=""> Data de Início</label>
            <div class="input-group">
              <input type="date" class="form-control" id="" value="2019-11-09" readonly />
            </div>
        </div>

          <div class="col-sm-6 col-md-3  form-group">
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


          <div class="col-sm-6 col-md-3 form-group">
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

          <div class="col-sm-6 col-md-3 form-group">
            <label for="">Material</label>
            <input type="text" class="form-control" id="" placeholder="parte do nome do material">
          </div>

          <div class="col-sm-6 col-md-3 form-group">
            <label for="">Lote</label>
            <input type="text" class="form-control" id="" placeholder="parte núm. lote">
          </div>






      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


    <div class="form-row">
      <div class="col-md-12" style="max-height:400px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr >
            <th class="thmaster bg-success" colspan="5" >Estoque</th>
            <th class="thmaster bg-success" colspan="2" >Inventáriado</th>
          </tr>
          <tr>
            <th>Material </th>
            <th>Lote </th>
            <th>Local</th>
            <th>Qtde</th>
            <th>Unid </th>
            <th>Contador</th>
            <th>Qtde</th>
          </tr>

          <tr>
            <td > Porca Sextavada M8 DIN 934 </td>
            <td > 2346762 </td>
            <td > A673 </td>
            <td > 132 </td>
            <td > pçs </td>
            <td> Gustavo da Silva </td>
            <td> 131 </td>
          </tr>

          <tr>
            <td > Parafuso Allen Cabeça baixa M8 DIN 912 </td>
            <td > 789762 </td>
            <td > A673 </td>
            <td > 157 </td>
            <td > pçs </td>
            <td> Mariana Teixeira </td>
            <td> 156 </td>
          </tr>

          <tr>
            <td > Parafuso Allen M10 DIN 912 </td>
            <td > 789762 </td>
            <td > A673 </td>
            <td > 168 </td>
            <td > pçs </td>
            <td > Girafales Veldez </td>
            <td > 167 </td>
          </tr>

        </table>
      </div><!--fim da listagem de locais-->
    </div>


</form> <!-- fim do formulário-->






    <div class="row mt-4">
      <div class="col-12 d-flex justify-content-around" id="">

        <button type="submit" class="btn btn-lg col-md-4 btn-success" style="width: 100%;"><i class="fas fa-search mr-2"></i>Localizar</button>
        <button type="button" class="btn btn-lg col-md-4 btn-success" onclick="history.back()" style="width: 100%;"> <i class="fas fa-ban mr-2"></i>Voltar</button>
      </div>
    </div>



</div>


@endsection
