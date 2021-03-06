@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

  <form action="/estoque/atualiza" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    
    <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
              
  

          <div class="form-group col-md-6">
            <label for="cod_material">Cód. de Estoque</label>
            <div class="input-group">
              <input type="number" class="form-control" id="cod_material" name="id" value="{{$estocado->id}}" readonly/>
              <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success" onclick="location.href='/estoque/gerenciar';"><i class="fab fa-sistrix"></i></button>
              </div>
            </div>
          </div>

          <div class="form-group col-md-6">
            <label for="cod_material">Cód. Material</label>
            <div class="input-group">
              <input type="number" class="form-control" id="cod_material" name="cod_material" value="{{$estocado->cod_material}}" readonly/>
            </div>
          </div>


           <div class="form-group col-12">
              <label for="nome_material">Desc. Material</label>
              <div class="input-group">  
                <input type="text" class="form-control" id="nome_material" name="nome_material" value="{{$estocado->material->nome_material}}" readonly/>
              </div>
            </div>

          <div class="form-group col-6">
            <label for="quantidade_id">Quantidade</label>
            <input type="text" class="form-control mb-3" id="quantidade_id" name="quantidade" onkeyup="verifica();" value="{{$estocado->quantidade}}"/>
          </div>

          <div class="form-group col-6">
            <label for="lote">Lote</label>
            <input type="text" class="form-control mb-3" id="lote" name="lote" value="{{$estocado->lote}}" />
          </div>


          <div class="form-group col-6">
              <label for="data_validade">Data Validade</label>
              <input type="date" class="form-control mb-3" id="data_validade" name="data_validade" value="{{ $estocado->getDataValidadeForm()}}"  readonly />             
            </div>

            <div class="form-group col-md-6">
              <label for="codLocal">Local de Armazenamento:</label>
              <div class="input-group">
                @if($view['operacao']=='ajusta')
                  <input type="text" class="form-control mb-3" name="" id="" value="{{$estocado->local->nome_local}}" readonly="readonly"/>
                  <input type="hidden" name="cod_local" id="" value="{{$estocado->cod_local}}" />
                @elseif($view['operacao']=='edita')
                  <select class="form-control" id="codLocal" name="cod_local">
                  @foreach($locais as $l)
                    <option value="{{$l->cod_local}}" @if($l->cod_local == $estocado->cod_local) selected @endif > {{$l->nome_local}} </option>
                  @endforeach
                  </select>
                @endif
                
              </div>
            </div>

            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

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

      @if ( session('status') == 'editado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material estocado foi atualizado com sucesso!
        </div>

      @elseif ( session('status') == 'naoEditado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material estocado NÃO pode ser editado!
        </div>

      @elseif ( session('status') == 'ajustado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O material estocado foi ajustado com sucesso!
        </div>

      @elseif ( session('status') == 'naoAjustado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O material estocado NÃO pode ser ajustado!
        </div>

      @endif
        
    </div>
  </div>


    <div class="row">
      <div class="col-md-12 d-flex justify-content-around mt-5" id="secao-botoes"> 
          <button type="submit" class="btn btn-lg btn-success  col-3" id="btnEstoqueSubmit"><i class="far fa-save"></i></button>
          <a href="/estoque/gerenciar" class="btn btn-lg btn-success  col-3"><i class="fas fa-ban"></i> Cancelar</a>
          <button type="reset" class="btn btn-lg btn-success  col-3"><i class="fas fa-broom"></i>Limpar</button>    
      </div>
    </div>

  </form> <!-- fim do formulário-->







@push('scripts')

<script>
  qtdeInicial = document.getElementById("quantidade_id").value;

  function verifica(){
    

      if( ! isNaN(document.getElementById("quantidade_id").value) ) {
          document.getElementById("quantidade_id").className = 'form-control mb-3';
          if(document.getElementById("quantidade_id").value != qtdeInicial) {
              document.getElementById("btnEstoqueSubmit").disabled = false;
          }else{
            document.getElementById("btnEstoqueSubmit").disabled = true;

          }
      }else{
          document.getElementById("btnEstoqueSubmit").disabled = true;
          document.getElementById("quantidade_id").className = 'form-control mb-3 bg-danger';
      } 
    
  }

  var operacao = "{{{ $view['operacao'] }}}" ;
  console.log('operacao: ');
  console.log(operacao);

  if (operacao=='edita'){
    document.getElementById("lote").readOnly = false;
    document.getElementById("data_validade").readOnly = false;
    document.getElementById("quantidade_id").readOnly = true;
    document.getElementById("btnEstoqueSubmit").insertAdjacentHTML("beforeend","Salvar");
  }
  if (operacao=='ajusta'){
    document.getElementById("lote").readOnly = true;
    document.getElementById("data_validade").readOnly = true;
    document.getElementById("quantidade_id").readOnly = false;
    document.getElementById("btnEstoqueSubmit").insertAdjacentHTML("beforeend","Ajustar");
    document.getElementById("btnEstoqueSubmit").disabled = true;

  }

</script>

@endpush

@endsection