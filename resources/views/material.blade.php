@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')


<form action="{{ session('material') ? '/material/atualiza' : '/material/adiciona'}}" class="ml-4 mr-4" method="post" > <!-- início do formulario -->



  <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->

    <input type="hidden" name="_token" value=" {{ csrf_token() }}" />

    <!-- QUANDO FOR EDITAR, VAI PUXAR OS DADOS -->
    @if(session('material'))
    <div class="col-md-6">

      <div class="form-group">
        <label for="cod_material">Código:</label>
        <input type="text" class="form-control" id="cod_material" name="cod_material" value="{{ session('material')->cod_material }}" readonly="readonly">
      </div>

      <div class="form-group">
        <label for="nome_material">Nome do Material:</label>
        <input type="text" class="form-control" id="nome_material" name="nome_material" value="{{ session('material')->nome_material }}" >
      </div>

      <div class="form-group">
        <label for="cod_tipo">Tipo de Material:</label>
        <div class="input-group">
          <select class="form-control" id="cod_tipo" name="cod_tipo">
            @foreach($tipos as $s)
            <option value="{{$s->cod_tipo}}" <?php echo session('material')->cod_tipo == $s->cod_tipo  ? 'selected' : '' ?> > {{$s->nome_tipo}} </option>
            @endforeach
          </select>
          <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-success" onclick="location.href='/tipo';"><i class="fas fa-sitemap"></i></button>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="cod_unid_medida">Unidade de Medida do Material:</label>
        <div class="input-group">
            <select class="form-control" id="cod_unid_medida" name="cod_unid_medida">
              @foreach($unidades as $c)
              <option value="{{$c->cod_unid_medida}}" <?php echo session('material')->cod_unid_medida == $c->cod_unid_medida  ? 'selected' : '' ?> > {{$c->descricao_unid_medida}} </option>
              @endforeach
            </select>
            <div class="input-group-append">
              <button type="button" class="btn btn-sm btn-success" onclick="location.href='/unidade';"><i class="fas fa-ruler"></i></button>
            </div>
        </div>
      </div>

    </div>

    <div class="col-md-6">

      <div class="form-group">
        <label for="estoque_min">Quantidade de Estoque Mínimo:</label>
        <div class="input-group">
          <input type="number" min="0" class="form-control" id="estoque_min" name="estoque_min" value="{{ session('material')->estoque_min }}">

          <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-success" onclick="btn_estoq_min()"><i class="fas fa-calculator"></i></button>
          </div>

        </div>
      </div>

      <div class="form-group">
        <label for="lead_time">Lead Time:</label>
        <input type="number" min="0" class="form-control" id="lead_time" name="lead_time" value="{{ session('material')->lead_time }}">
      </div>

      <div class="form-group">
        <label for="cons_dia">Consumo Diário:</label>
        <div class="input-group">
          <input type="number" min="0" class="form-control" id="cons_dia_id" name="cons_dia" value="{{ session('material')->cons_dia }}">
          <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-success" onclick="btn_cons_dia();" ><i class="fas fa-calculator"></i></button>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="estoque_seg">Estoque de Segurança:</label>
        <input type="number" min="0" class="form-control" id="estoque_seg" name="estoque_seg" value="" disabled>
      </div>

    </div>


    <!-- QUANDO FOR inserir, VAI ESTAR TUDO EM BRANCO -->
    @else
    <div class="col-md-6">

      <div class="form-group">
        <label for="nome_material">Nome do Material:</label>
        <input type="text" class="form-control" id="nome_material" name="nome_material">
      </div>

      <div class="form-group">
        <label for="cod_tipo">Tipo de Material:</label>
        <div class="input-group">
          <select class="form-control" id="cod_tipo" name="cod_tipo">
            @foreach($tipos as $c)
            <option value="{{$c->cod_tipo}}">{{$c->nome_tipo}}</option>
            @endforeach
          </select>
          <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-success" onclick="location.href='/tipo';"><i class="fas fa-sitemap"></i></button>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="cod_unid_medida">Unidade de Medida do Material:</label>
        <div class="input-group">
          <select class="form-control" id="cod_unid_medida" name="cod_unid_medida">
            @foreach($unidades as $c)
            <option value="{{$c->cod_unid_medida}}">{{$c->descricao_unid_medida}}</option>
            @endforeach
          </select>
          <div class="input-group-append">
            <button type="button" class="btn btn-sm btn-success" onclick="location.href='/unidade';"><i class="fas fa-ruler"></i></button>
          </div>
        </div>
      </div>

    </div>


    <div class="col-md-6">

      <div class="form-group">
        <label for="estoque_min">Quantidade de Estoque Mínimo:</label>
        <div class="input-group">
          <input type="number" min="0" class="form-control" id="estoque_min" name="estoque_min">
          <button type="button" class="btn btn-sm btn-success" onclick="btn_estoq_min()"><i class="fas fa-calculator"></i></button>
        </div>
      </div>

      <div class="form-group">
        <label for="lead_time">Lead Time:</label>
        <input type="number" min="0" class="form-control" id="lead_time" name="lead_time">
      </div>

      <div class="form-group" >
        <label for="cons_dia">Consumo Diário:</label>
        <div class="input-group">
          <input type="number" min="0" value="0" class="form-control" id="cons_dia_id" name="cons_dia">
        </div>
      </div>

    </div>

@endif

  @if (count($errors) > 0)
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @else
    @if(old('nome_material') && session('operacao')=='incluido')
    <div class="alert alert-success" role="alert">
      <strong>Sucesso:</strong> Material {{old('nome_material')}} foi adicionado!
    </div>
    @endif

    @if(session('operacao')=='atualizado')
    <div class="alert alert-success" role="alert">
      <strong>Sucesso:</strong> Material {{old('nome_material')}} foi atualizado!
    </div>
    @endif
  @endif

  </div> <!-- fim da div row da parte do forumulario-->



  <!-- BOTOES -->
  <div class="row">
    <div class="col-md-12 d-flex justify-content-around mt-3" id="secao-botoes">
    @if(session('material'))
      <button type="submit" class="btn btn-lg btn-success"><i class="far fa-save"></i>Salvar</button>
       <button type="button" class="btn btn-lg btn-success" onclick="window.location.href='/material';" > <i class="fas fa-ban"></i>Cancelar</button>
    @else
      <button type="submit" class="btn btn-lg btn-success"><i class="fas fa-check"></i>Cadastrar</button>
    @endif
      <button type="reset" class="btn btn-lg btn-success"><i class="fas fa-broom"></i>Limpar</button>
    </div>
  </div>

</form> <!-- fim do formulário-->



  @push('scripts')
    <script>
      function btn_cons_dia() {
        var id = document.getElementById('cod_material').value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById("cons_dia_id").value = this.responseText;

          }
        };
        xhttp.open("GET", "/material/consumodiario/" + id , true);
        xhttp.send();
      }

    </script>

<script>
function btn_estoq_min(){
    var leadtime = document.getElementById("lead_time").value;
    var cons_dia = document.getElementById("cons_dia_id").value;
    var estoque_min = ( leadtime * cons_dia ) ;

    document.getElementById("estoque_min").value = estoque_min;

    var estoque_seg = estoque_min + (leadtime * cons_dia);

    document.getElementById("estoque_seg").value = estoque_seg;

}
</script>

@if(session('material'))
<script type="text/javascript">
    window.onload = function(){
    var leadtime = document.getElementById("lead_time").value;
    var cons_dia = document.getElementById("cons_dia_id").value;
    var estoque_min = ( leadtime * cons_dia ) ;
    var estoque_seg = estoque_min + (leadtime * cons_dia);

    document.getElementById("estoque_seg").value = estoque_seg;
    }
    </script>
@endif

  @endpush

@endsection
