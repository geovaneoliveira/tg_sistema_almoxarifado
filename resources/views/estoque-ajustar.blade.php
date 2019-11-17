@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

  <form action="/estoque/atualiza" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    
    <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
      <div class="d-flex flex-wrap col-md-12">           
        <div class="col-sm-12 col-md-6">

          <div class="form-group">
            <label for="cod_material">Cód. de Estoque</label>
            <div class="input-group">
              <input type="number" class="form-control" id="cod_material" name="id" value="{{$estocado->id}}" readonly/>
              <div class="input-group-append">
                <button type="button" class="btn btn-sm btn-success" onclick="location.href='/estoque/gerenciar';"><i class="fab fa-sistrix"></i></button>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="cod_material">Cód. Material</label>
            <div class="input-group">
              <input type="number" class="form-control" id="cod_material" name="cod_material" value="{{$estocado->cod_material}}" readonly/>
            </div>
          </div>

          <div class="form-group">
            <label for="nome_material">Desc. Material</label>
            <div class="input-group">  
              <input type="text" class="form-control" id="nome_material" name="nome_material" value="{{$estocado->material->nome_material}}" readonly/>
            </div>
          </div>

          </div>

          <div div class="col-sm-12 col-md-6">

            <label for="lote">Lote</label>
          <input type="text" class="form-control mb-3" id="lote" name="lote" value="{{$estocado->lote}}" />

            <label for="quantidade">Quantidade</label>
            <input type="number" class="form-control mb-3" id="quantidade" name="quantidade" value="{{$estocado->quantidade}}"/>

            <div class="form-group">
              <label for="data_validade">Data Validade</label>
              <input type="date" class="form-control mb-3" id="data_validade" name="data_validade" value="{{ $estocado->getDataValidadeForm()}}"  readonly />             
            </div>

            <div class="form-group">
              <label for="codLocal">Local de Armazenamento:</label>
              <div class="input-group">
                @if($view['operacao']=='ajusta' || $view['operacao']=='ajustado')
                  <input type="text" class="form-control mb-3" name="" id="" value="{{$estocado->local->nome_local}}" readonly="readonly"/>
                  <input type="hidden" name="cod_local" id="" value="{{$estocado->cod_local}}" />
                @elseif($view['operacao']=='edita' || $view['operacao']=='editado')
                  <select class="form-control" id="codLocal" name="cod_local">
                  @foreach($locais as $l)
                    <option value="{{$l->cod_local}}" @if($l->cod_local == $estocado->cod_local) selected @endif > {{$l->nome_local}} </option>
                  @endforeach
                  </select>
                @endif
                
              </div>
            </div>

            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

          </div>



      @if (count($errors) > 0)
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @else
        @if(old('nome_material') && session('operacao')=='alocado')
        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> Material {{old('nome_material')}} foi alocado com sucesso!
        </div>
        @endif

        @if ( $view["operacao"] == 'ajustado' )
        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O Material estocado {{old('nome_material')}} foi ajustado com sucesso!
        </div>
        @endif

      @endif
     


      </div> 
     </div> <!-- fim da div row da parte do forumulario--> 

    <div class="row">
      <div class="col-md-12 d-flex justify-content-around mt-5" id="secao-botoes"> 
          <button type="submit" class="btn btn-lg btn-success " id="btnEstoqueSubmit"><i class="far fa-save"></i></button>
          <a href="/estoque/gerenciar" class="btn btn-lg btn-success"><i class="fas fa-ban"></i> Cancelar</a>
          <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>    
      </div>
    </div>

  </form> <!-- fim do formulário-->







@push('scripts')

<script>

  var operacao = "{{{ $view['operacao'] }}}" ;
  console.log('operacao: ');
  console.log(operacao);

  if (operacao=='edita' || operacao=='editado'){
    document.getElementById("lote").readOnly = false;
    document.getElementById("data_validade").readOnly = false;
    document.getElementById("quantidade").readOnly = true;
    document.getElementById("btnEstoqueSubmit").insertAdjacentHTML("beforeend","Salvar");
  }
  if (operacao=='ajusta' || operacao=='ajustado'){
    document.getElementById("lote").readOnly = true;
    document.getElementById("data_validade").readOnly = true;
    document.getElementById("quantidade").readOnly = false;
    document.getElementById("btnEstoqueSubmit").insertAdjacentHTML("beforeend","Ajustar");
  }

</script>

@endpush

@endsection