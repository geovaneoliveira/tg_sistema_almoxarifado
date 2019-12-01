@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

  <form id="formEstoque" action="/material/estocar" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    
    <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
      <div class="d-flex flex-wrap col-md-12">           
        <div class="col-sm-12 col-md-6">

          <div class="form-group">
            <label for="cod_material">Cód. Material</label>
            <div class="input-group">
              <input type="number" class="form-control" id="cod_material" name="cod_material" value="{{$material->cod_material}}" readonly="readonly"/>
              <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success" onclick="location.href='/material/consulta';"><i class="fab fa-sistrix"></i></button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="nome_material">Desc. Material</label>
            <div class="input-group">  
              <input type="text" class="form-control" id="nome_material" name="nome_material" value="{{$material->nome_material}}" readonly="readonly"/>
            </div>
          </div>


          <label for="lote">Lote</label>
          <input type="text" class="form-control mb-3" id="lote" name="lote"/>

          </div>

          <div div class="col-sm-12 col-md-6">

            <div class="form-group">
          <label for="quantidade">Quantidade</label>
          <div class="input-group">
            <input type="number" class="form-control" id="quantidade" name="quantidade"/>
              <div class="input-group-append">
                <label class="col-1 col-form-label"> {{$material->unidade->descricao_unid_medida}} </label>
              </div>
          </div>
          </div>

          <label for="data_validade">Data Validade</label>
          <input type="date" class="form-control mb-3" id="data_validade" name="data_validade" autocomplete="on" />

          <div class="form-group">
            <label for="codLocal">Local de Armazenamento:</label>
            <div class="input-group">
              <select class="form-control" id="codLocal" name="cod_local">
                @foreach($locais as $l)
                    <option value="{{$l->cod_local}}" > {{$l->nome_local}} </option>
                @endforeach
              </select>
            </div>
          </div>

          <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

        </div>

      </div> 
 

     </div> <!-- fim da div row da parte do forumulario--> 


<div class="row mt-3">
  <div class="col-12">
    

      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>

      @endif

      @if ( session('status') == 'alocado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material foi alocado com sucesso no estoque!
        </div>

      @elseif ( session('status') == 'naoAlocado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material NÃO pode ser alocado!
        </div>

      @endif
  
</div>
</div>



  



    <div class="row">
      <div class="col-md-12 d-flex justify-content-around mt-5" id="secao-botoes"> 
          <button type="submit" class="btn btn-lg btn-success col-3"><i class="far fa-save"></i>Alocar</button>
           <button type="button" class="btn btn-lg btn-success col-3" onclick="history.back()" > <i class="fas fa-ban"></i>Cancelar</button>
          <button type="reset" class="btn btn-lg btn-success col-3"><i class="fas fa-broom"></i>Limpar</button>
      </div>
    </div>

  </form> <!-- fim do formulário-->

@endsection