@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<form action="/estoque/localiza" class="ml-4 mr-4" method="post"> <!-- início do formulario -->


  <div class="form">  

    <div class="d-flex flex-wrap " style="width: 100%;">

<div class="form-row d-flex align-items-end" style="width: 100%;">
  <div class="form-group col-sm-7 col-md-8">
              <label for="nome_material">Nome do Material:</label>
              <input type="text" class="form-control" id="nome_material" name="nome_material">

          <label for="lote">Lote:</label>
          <input type="text" class="form-control" id="lote" name="lote">

      </div>

      <div class="col-sm-5 col-md-4 form-group" style="width: 100%;">
            <fieldset class="border p-2">
              <legend class=" m-0 p-0" style="font-size: 1em;">Tipo de Movimentação</legend>
                
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Aquisição
                </div>

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Requisição
                  </label>
                </div> 

                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Ajuste 
                  </label>
                </div>  
              
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                  <label class="form-check-label" for="defaultCheck1">
                    Inventário
                  </label>
                </div>        

            </fieldset>
          </div>
  
</div>
      
      <div class="form-row d-flex align-items-end" style="width: 100%;">

        <div class="form-group col col-md-6">
        <label for="cod_tipo">Tipo de Material:</label>
        <div class="input-group" >
          <select class="form-control" id="cod_tipo" name="cod_tipo">
            <option value="">todos</option>
            @foreach($tipos as $t)
            <option value="{{$t->cod_tipo}}">{{$t->nome_tipo}}</option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="form-group col col-md-6">
        <label for="cod_local">Local:</label>
        <div class="input-group" >
          <select class="form-control" id="cod_local" name="cod_local">
            <option value="">todos</option>
            @foreach($locais as $l)
            <option value="{{$l->cod_local}}">{{$l->nome_local}}</option>
            @endforeach
          </select>
        </div>
      </div>

        <div class="col-sm-12 col-md-6 form-group">
            <label for=""> Período </label>
            <div class="input-group">
              <input type="date" class="form-control" id="">             
              <input type="date" class="form-control" id="">
            </div>            
        </div>  

                <div class="col-sm-12 col-md-6 form-group">
            <label for=""> Responsável </label>
            <div class="input-group">
              <input type="text" class="form-control" id="" placeholder="parte do nome do Responsável">             
            </div>            
        </div> 
        
      </div>


      



      <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
    </div>

  </div> <!--fim da primeira linha-->


    <div class="row" style="max-height: 300px; overflow-y: auto;" ><!--inicio da listagem de locais-->
      <div class="col">
        <table class="table table-sm table-bordered table-hover ">
        <tr>
          <th>Material</th>
          <th>Local</th>
          <th>Lote</th>
          <th>Data/Hora</th>
          <th>Tipo</th>
          <th>Qtde</th>
          <th>Responsável</th>
          <th>Requ.</th>
        </tr>
        <tr>
          <td > Uniforme Camiseta Branca tam GG</td>
          <td > G345 </td>
          <td > 6754 </td>
          <td > 13/04/2018 </td>
          <td > Aquisição </td>
          <td > +80 </td>
          <td>Geovane Viana</td>
          <td> </td>
        </tr>
        <tr>
          <td > Uniforme Camiseta Branca tam GG</td>
          <td > G345 </td>
          <td > 6754 </td>
          <td > 13/04/2019 12:35</td>
          <td > Inventário </td>
          <td > -8 </td>
          <td>Geovane Viana</td>
          <td> </td>
        </tr>
        <tr>
          <td > Parafuso Allen s/ Cabeça M12x30</td>
          <td > G345 </td>
          <td > 4739 </td>
          <td > 31/07/2019 11:43 </td>
          <td > Aquisição </td>
          <td > +25 </td>
          <td>Geovane Viana</td>
          <td> </td>
        </tr>
        <tr>
          <td > Parafuso Allen s/ Cabeça M12x30</td>
          <td > G345 </td>
          <td > 4739 </td>
          <td > 05/08/2019 18:43 </td>
          <td > Requisição </td>
          <td > -8 </td>
          <td>Geovane Viana</td>
          <td> 34556 </td>
        </tr>
        <tr>
          <td > Parafuso Allen s/ Cabeça M12x30</td>
          <td > G345 </td>
          <td > 4939 </td>
          <td > 10/08/2019 19:33 </td>
          <td > Ajuste </td>
          <td > -1 </td>
          <td>Geovane Viana</td>
          <td> </td>
        </tr>
        <tr>
          <td > Parafuso Allen s/Cabeça M12x30</td>
          <td > G345 </td>
          <td > 4739 </td>
          <td > 11/08/2019 07:02 </td>
          <td > Ajuste </td>
          <td > +3 </td>
          <td>Geovane Viana</td>
          <td> </td>
        </tr>
        <tr>
          <td > Parafuso Allen s/ Cabeça M12x30</td>
          <td > G345 </td>
          <td > 4739 </td>
          <td > 12/08/2019 09:30</td>
          <td > Inventário </td>
          <td > +3 </td>
          <td>Geovane Viana</td>
          <td> </td>
        </tr>

      </table>
        
      </div>
      
    </div><!--fim da listagem de locais-->

  <div class="row">
    <div class="col d-flex justify-content-around mt-2" id="secao-botoes">
        <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-search"></i>Localizar</button>
        <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>
    </div>
  </div>

</form> <!-- fim do formulário-->






@endsection
