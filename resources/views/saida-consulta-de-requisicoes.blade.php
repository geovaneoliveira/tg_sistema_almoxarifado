@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="col-12">
  <form class="">
    <div class="form-row d-flex align-items-end">

        <div class="col-sm-6 col-md-4 form-group">
          <label for="">Núm. Requisição</label>
          <input type="text" class="form-control" id="" placeholder="código">
        </div>

        <div class="col-sm-6 col-md-4 form-group">
          <label for="cod_tipo">Situação</label>
          <div class="input-group">
            <select class="form-control" id="cod_tipo" name="cod_tipo">
              <option value=""> Todas </option>
              <option value="Aberta"> Aberta </option>
              <option value="Aberta"> Finalizada </option>
              <option value="Negada"> Negada </option>
            </select>
          </div>
        </div>

        <div class="col-sm-12 col-md-4 form-group">
          <label for="">Requisitante</label>
          <input type="text" class="form-control" id="" placeholder="parte do nome do requisitante">
        </div>

        <div class="col-sm-12 col-md-6 form-group">
            <label for=""> Data de Requisição</label>
            <div class="input-group">
              <input type="date" class="form-control" id="">             
              <input type="date" class="form-control" id="">
            </div>            
        </div>  

        <div class="col-sm-12 col-md-6 form-group">
            <label for=""> Data de Finalização</label>
            <div class="input-group">
              <input type="date" class="form-control" id="">             
              <input type="date" class="form-control" id="">
            </div>            
        </div>                       

      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>


    <div class="form-row">
      <div class="col-md-12" style="height: 225px; overflow-y: auto;" ><!--inicio da listagem de materiais-->
        <table class="table table-sm table-bordered table-hover " style="text-align: center;">
          <tr>
            <th>Número</th>
            <th>Requisitante</th>
            <th>Data Requ. </th>
            <th>Data Atend.</th>  
            <th>Situação</th>
            <th style="width: 5%;" ></th>          
            <th style="width: 5%;" ></th> 
            <th style="width: 5%;" ></th>         
          </tr>
          <tr>
            <td> 67302 </td>
            <td> Geovane Viana </td>
            <td> 05/10/2018 </td>
            <td>   </td>
            <td> Aberta </td>
            <td> <a href="/saida/nega/67302"> <span class="fas fa-minus-circle text-danger">       </span> </a> </td>
            <td> <a href="/saida/exibeDetalhes/67302"> <span class="far fa-eye">       </span> </a> </td>
            <td> <a href="/saida/atende/67302"> <span class="fas fa-dolly-flatbed text-success">   </span> </a> </td> 
          </tr>

          <tr>
            <td> 57592 </td>
            <td> Mariana Fogaça </td>
            <td> 07/10/2018 </td>
            <td>   </td>
            <td> Aberta </td>
            <td> <a href="/saida/nega/57592"> <span class="fas fa-minus-circle text-danger">            </span> </a> </td>
            <td> <a href="/saida/exibeDetalhes/57592"> <span class="far fa-eye"> </span> </a> </td> 
            <td> <a href="/saida/atende/57592"> <span class="fas fa-dolly-flatbed text-success">       </span> </a> </td>
          </tr>

          <tr>
            <td> 47592 </td>
            <td> Gustavo Torres </td>
            <td> 07/08/2019 </td>
            <td> 08/08/2019 </td>
            <td> Finalizada </td>
            <td>   </td>
            <td> <a href="/minhas-requisicoes/exibeDetalhes/47592"> <span class="far fa-eye">       </span> </a> </td> 
            <td>   </td>
          </tr>

          <tr>
            <td> 98732 </td>
            <td> Jean de Picolé </td>
            <td> 13/10/2019 </td>
            <td> 14/10/2019 </td>
            <td> Finalizada </td>
            <td>  </td>
            <td> <a href="/minhas-requisicoes/exibeDetalhes/98732"> <span class="far fa-eye">       </span> </a> </td> 
            <td>  </td>
          </tr>

          <tr>
            <td> 99448 </td>
            <td> Letícia Pereira Inácio da Silva </td>
            <td> 13/10/2019 </td>
            <td> 14/10/2019 </td>
            <td> Negada </td>
            <td>  </td>
            <td> <a href="/minhas-requisicoes/exibeDetalhes/98732"> <span class="far fa-eye">       </span> </a> </td>
            <td>  </td> 
          </tr>

        </table>
      </div><!--fim da listagem de locais-->
    </div>


  <div class="form-row">
    <div class="col d-flex justify-content-around mt-3" id="secao-botoes">
        <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-search"></i>Localizar</button>
        <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>
    </div>
  </div>

</form> <!-- fim do formulário-->
  
</div>







@endsection
