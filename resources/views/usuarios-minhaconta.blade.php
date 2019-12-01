@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

  <form action="/user/atualizabyuser" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    
    <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
      <div class="d-flex flex-wrap col p-0">           
            <div class="col col-md-6">
                <label for="id">Código do Usuário:</label>
                <input type="text" class="form-control mb-3" id="id" name="id" value="{{Auth::user()->id}}" readonly="readonly"/>
               
                <label for="name">Nome:</label>           
                <input type="text" class="form-control mb-3" id="name" name="name"  value="{{Auth::user()->name}}" autocomplete="name"/>

                <label for="email">E-mail:</label>           
                <input type="text" class="form-control mb-3" id="email" name="email" value="{{Auth::user()->email}}"  autocomplete="email" />

            </div>



          <div class="col col-md-6">
                <label for="passwordlUser">Senha:</label>           
                <input type="password" class="form-control mb-3" id="password" name="password" value="" required autocomplete="new-password"/>

                <label for="password-confirm">Confirmar Senha:</label>           
                <input type="password" class="form-control mb-3" id="password-confirm" name="password_confirmation" value="" required autocomplete="new-password"/>

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

        @if(session('operacao')=='atualizado')
        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> Usuário {{old('name')}} foi atualizado!
        </div>
        @endif

      @endif

      

      </div> 
 

     </div> <!-- fim da div row da parte do forumulario--> 



    <div class="form-row">
    <div class="col d-flex justify-content-around mt-3" id="secao-botoes">
        <button type="submit" class="btn btn-lg btn-success col-3"><i class="far fa-save"></i>Salvar</button>         
        <button type="reset" class="btn btn-lg btn-success  col-3"><i class="fas fa-broom"></i>Limpar</button> 
    </div>
  </div>

  </form> <!-- fim do formulário-->






@endsection