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
              <option value='1'  <?php echo session('user')->permission == '1'   ? 'selected' : '' ?> >1 - Coordenador</option>
              <option value='2'  <?php echo session('user')->permission == '2'   ? 'selected' : '' ?> >2 - Almoxarife</option>
              <option value='3'  <?php echo session('user')->permission == '3'   ? 'selected' : '' ?> >3 - Requisitante</option>
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
              <option value="-1" >Todas</option>
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
    <div class="col-12 mt-1 mb-1" style="text-align: center;">
      <label>Legenda:</label>   
      <span class="fas fa-pencil-alt text-primary ml-3 mr-1"> Editar </span>
      <span class="fas fa-eraser text-warning ml-3 mr-1"> Redefinir </span> 
      <span class="fas fa-trash text-danger ml-3 mr-1"> Excluir </span>              
    </div>
    @endisset


<div class="row mt-1 mb-1">
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


      @if ( session('status') == 'excluido' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O usuário foi excluído do sistema com sucesso!
        </div>
          
      @elseif ( session('status') == 'naoExcluido' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O usuário NÃO pode ser excluído do sistema!
        </div>

      @elseif ( session('status') == 'resetado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> A senha do usuário foi redefinida com sucesso. Agora ela equivale ao seu e-Mail!
        </div>

      @elseif ( session('status') == 'naoResetado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O senha do usuário NÃO pode ser redefinida!
        </div>

      @elseif ( session('status') == 'editado' )

        <div class="alert alert-success" role="alert">
          <strong>Sucesso:</strong> O usuário foi atualizado com sucesso!
        </div>

      @elseif ( session('status') == 'naoEditado' )

        <div class="alert alert-danger" role="alert">
          <strong>Atenção:</strong> O usuário NÃO pode ser editado!
        </div>

      @endif



    
  </div>
</div>



    <div class="row">
      <div class="col d-flex justify-content-around mt-1" id="secao-botoes">
        @if(session('operacao')=='editar')
          <button type="submit" class="btn btn-lg btn-success col-3"><i class="far fa-save"></i>Salvar</button>
          <a href="/user/gerenciar" class="btn btn-lg btn-success col-3"><i class="fas fa-ban">  Cancelar</i></a>
        @else
          <button type="submit" class="btn btn-lg btn-success col-3"><i class="fas fa-search"></i>Localizar</button>          
        @endif              
          <button type="reset" class="btn btn-lg btn-success col-3"><i class="fas fa-broom"></i>Limpar</button>    
      </div>
    </div>

  </form> <!-- fim do formulário-->






@endsection