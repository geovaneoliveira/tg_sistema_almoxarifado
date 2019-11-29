@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

  <form action="{{ session('user') ? '/user/atualiza' : '/user/localiza'}}" class="ml-4 mr-4" method="post"> <!-- início do formulario -->

    
    <div class="row">    <!-- verificar classes is-valid e is-invalid para serem aplicadas via javaScript -->   
      <div class="d-flex flex-wrap col p-0">           
              
        @if(session('user'))

          <div class="form-group col-md-6">
            <label for="id">Código do Usuário:</label>
            <input type="text" class="form-control" id="id" name="id" value="{{ session('user')->id }}" readonly="readonly"/>                
          </div>

          <div class="form-group col-md-6">
            <label for="name">Nome:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ session('user')->name }}" />
          </div>

          <div class="form-group col-md-6">
            <label for="email">E-mail:</label>           
            <input type="email" class="form-control" id="email" name="email" value="{{ session('user')->email }}" required autocomplete="email" />
          </div>

          <div class="form-group col-md-6">
            <label for="nivelPermUsuario">Nível de Permissão: </label>
            <select class="form-control" id="nivelPermUsuario" name="permission" >
              <option value=""   <?php echo session('user')->permission == null  ? 'selected' : '' ?> >Permissão não atribuida</option>
              <option value='1'  <?php echo session('user')->permission == '1'  ? 'selected' : '' ?> >1 - Coordenador</option>
              <option value='2'  <?php echo session('user')->permission == '2'  ? 'selected' : '' ?> >2 - Almoxarife</option>
              <option value='3'  <?php echo session('user')->permission == '3'  ? 'selected' : '' ?> >3 - Requisitante</option>
            </select> 
         </div>

        @else   

          <div class="form-group col-md-4">
            <label for="name">Nome:</label>           
            <input type="text" class="form-control" id="name" name="name"  value="" autocomplete="name"/>
          </div>

          <div class="form-group col-md-4">  
            <label for="email">E-mail:</label>           
            <input type="text" class="form-control" id="email" name="email" value=""  autocomplete="email" />
          </div>

          <div class="form-group col-md-4">
            <label for="nivelPermUsuario">Nível de Permissão:</label>
            <select class="form-control" id="nivelPermUsuario" name="permission">
              <option value="" >Permissão não atribuida</option>
              <option value='1'>1 - Coordenador</option>
              <option value='2'>2 - Almoxarife</option>
              <option value='3'>3 - Requisitante</option>
            </select> 
          </div>

        @endif

        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

      </div> 
 
    </div> <!-- fim da div row da parte do forumulario--> 

    @if (count($errors) > 0)

      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>

    @else

      @if(old('name') && session('operacao')=='incluido')
      <div class="alert alert-success" role="alert">
        <strong>Sucesso:</strong> Usuário {{old('name')}} foi adicionado!
      </div>
      @endif

      @if(session('operacao')=='atualizado')
      <div class="alert alert-success" role="alert">
        <strong>Sucesso:</strong> Usuário {{old('name')}} foi atualizado!
      </div>
      @endif

      @if(session('operacao')=='resetado')
      <div class="alert alert-success" role="alert">
        <strong>Sucesso:</strong> a senha do usuário foi resetada e corresponde ao seu email!
      </div>
      @endif

      @if(session('operacao')=='deletado')
      <div class="alert alert-success" role="alert">
        <strong>Sucesso:</strong> o usuario foi deletado com sucesso!
      </div>
      @endif

    @endif

    @isset($users)
      <div class="row" style="height-max: 225px; overflow-y: auto;" ><!--inicio da listagem de users-->
        <div class="col">
          <table class="table table-sm table-bordered table-hover">
            <tr>
              <th>Nome</th>
              <th>e-Mail</th>
              <th>Perm.</th>
            </tr>
            @foreach ($users as $u)
              <tr>
                <td> {{$u->name}} </td>
                <td> {{$u->email}} </td>
                <td> {{$u->permission}} </td>
                <td style="text-align: center;"> <a href="/user/edita/{{$u->id}}"> <span class="fas fa-pencil-alt"> </span> </a> </td>
                <td style="text-align: center;"> <a href="/user/reseta/{{$u->id}}"> <span class="fas fa-eraser text-warning"></span> </a> </td>
                <td style="text-align: center;"> <a href="/user/remove/{{$u->id}}"> <span class="fas fa-trash text-danger"></span> </a> </td>        
              </tr>
            @endforeach
          </table>            
        </div>          
      </div><!--fim da listagem de users-->
    @endisset

    <div class="row">
      <div class="col d-flex justify-content-around mt-5" id="secao-botoes">
        @if(session('operacao')=='editar')
          <button type="submit" class="btn btn-lg btn-success col-3"><i class="far fa-save"></i>Salvar</button>
          <a href="/user/gerenciar" class="btn btn-lg btn-success col-3"><i class="fas fa-ban">  Cancelar</i></a>
        @else
          <button type="submit" class="btn btn-lg btn-success col-3"><i class="fas fa-check"></i>Localizar</button>          
        @endif              
          <button type="reset" class="btn btn-lg btn-success col-3"><i class="fas fa-broom"></i>Limpar</button>    
      </div>
    </div>
  </form> <!-- fim do formulário-->






@endsection