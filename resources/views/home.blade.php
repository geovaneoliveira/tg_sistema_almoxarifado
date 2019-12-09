@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="container">
  <div class="row d-flex wrap">
    @if ($view['inventario']==true)
        <div class="col-md-6 ">
          <div class="accordion" id="accordionExample1">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4">
                <h5 class="card-title text-success"> <i class="fas fa-check-square fa-lg menu-icone"></i> Inventário em Andamento </h5>
              </div>
              <div class="card-body ">
                <p class="card-text">Há um inventário em andamento e por isso o funcionamento do sistema está limitado. Movimentações de entrada e saída só serão permitidas após a finalização do inventário em andamento.</p>
              </div>
            </div>
          </div>
          </div>
      @endif
    <div class="col-md-6 ">



      @if ($view['inventario']==false)

        @if (count($materiaisAbaixoEstoqueSeg) > 0)
          <div class="accordion " id="accordionExample1">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4" style="background-color: #FFFF66;"  >
                <h5 class="card-title "> <i class="fas fa-cubes fa-lg menu-icone "></i> Estoque de Segurança Atingido!</h5>
              </div>
              <div class="card-body " style="background-color: #FFFF99;">
                <p class="card-text"><strong>Atenção:</strong> {{count($materiaisAbaixoEstoqueSeg)}} materiais parecem ter atingido o estoque de segurança e exigem a sua atenção.</p>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                  <a class="text-muted">ver materiais...</a>
                </button>
              </div>
              <div id="collapse1" class="collapse"  data-parent="#accordionExample1">
                <ul class="list-group text-muted">
                  @foreach ($materiaisAbaixoEstoqueSeg as $maes)
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                      <a href="/material/aloca/{{$maes->cod_material}}">{{$maes->nome_material}}</a>
                      <span class="badge badge-pill" style="background-color: #FFFF66;" >{{$maes->estoque_total}} de {{$maes->estoque_seg}} </span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @else
          <div class="accordion " id="accordionExample1">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4">
                <h5 class="card-title text-success"> <i class="fas fa-cubes fa-lg menu-icone"></i> Estoque de Segurança </h5>
              </div>
              <div class="card-body ">
                <p class="card-text">Nenhum material parece ter atingido o estoque de segurança.</p>
              </div>
            </div>
          </div>
        @endif

      @endif

      @if ($view['inventario']==false)

        @if (count($materiaisAbaixoEstoqueMin) > 0)
          <div class="accordion " id="accordionExample2">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4" style="background-color: #FA9A8F;">
                <h5 class="card-title"> <i class="fas fa-cubes fa-lg menu-icone"></i> Estoque Mínimo Atingido </h5>
              </div>
              <div class="card-body " style="background-color: #FAB3AB;">
                <p class="card-text"><strong>Atenção:</strong> {{count($materiaisAbaixoEstoqueMin)}} materiais parecem ter atingido o estoque mínimo e exigem a sua atenção urgente!</p>
                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                  <a class="text-muted">ver materiais...</a>
                </button>
              </div>
              <div id="collapse2" class="collapse"  data-parent="#accordionExample2">
                <ul class="list-group text-muted">
                  @foreach ($materiaisAbaixoEstoqueMin as $maem)
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                      <a href="/material/aloca/{{$maem->cod_material}}">{{$maem->nome_material}}</a>
                      <span class="badge badge-pill" style="background-color: #FA9A8F;">{{$maem->estoque_total}} de {{$maem->estoque_min}} </span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @else
          <div class="accordion " id="accordionExample1">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4">
                <h5 class="card-title text-success"> <i class="fas fa-cubes fa-lg menu-icone"></i> Estoque Mínimo </h5>
              </div>
              <div class="card-body ">
                <p class="card-text">Nenhum material parece ter atingido o estoque mínimo.</p>
              </div>
            </div>
          </div>S
        @endif

      @endif

        @if (Auth::user()->permission == 1)
          @if ($usuariosSemPermissao->count() > 0)
            <div class="accordion" id="accordionExample4">
              <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
                <div class="card-header pt-4" style="background-color: #FFFF66;" >
                  <h5 class="card-title"><i class="fas fa-users fa-lg menu-icone" ></i>Permissão para novos usuários </h5>
                </div>
                <div class="card-body" style="background-color: #FFFF99;" >
                  <p class="card-text">Parece que {{ $usuariosSemPermissao->count() }} novos usuários se registraram no sistema e precisam da sua autorização de acesso.</p>
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    <a class="text-muted">Ver usuários...</a>
                  </button>
                </div>
                <div id="collapse4" class="collapse"  data-parent="#accordionExample4">
                  <ul class="list-group text-muted">
                    @foreach ($usuariosSemPermissao as $u)
                      <li class="list-group-item d-flex justify-content-between align-items-center ">
                        <a href="/user/edita/{{$u->id}}">{{$u->name}}</a>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          @else
            <div class="accordion " id="accordionExample1">
              <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
                <div class="card-header pt-4">
                  <h5 class="card-title text-success"> <i class="fas fa-users fa-lg menu-icone"></i> Permissão para novos usuários </h5>
                </div>
                <div class="card-body ">
                  <p class="card-text">Todos os usuários estão devidamente cadastrados quanto as suas permissões de acesso</p>
                </div>
              </div>
            </div>
          @endif
        @endif

    </div>

    <div class="col-md-6 ">

      @if ($view['inventario']==false)

        @if ($estoquesVencidos->count() > 0)
          <div class="accordion " id="accordionExample3">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4" style="background-color: #FA9A8F;">
                  <h5 class="card-title"><i class="fas fa-building fa-lg menu-icone"></i>Validade de Lotes em Estoque </h5>
              </div>
              <div class="card-body "  style="background-color: #FAB3AB;">
                  <p class="card-text"><strong>Atenção:</strong> {{$estoquesVencidos->count()}} lotes parecem estar com a data de validade vencida e exigem a sua atenção.</p>
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                    <a class="text-muted">ver lotes...</a>
                  </button>
              </div>
              <div id="collapse3" class="collapse"  data-parent="#accordionExample3">
                <ul class="list-group text-muted">
                  @foreach ($estoquesVencidos as $ev)
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                      <a href="/estoque/ajusta/{{$ev->id}}">{{$ev->material->nome_material}} (Local: {{$ev->local->nome_local}} )</a>
                      <span class="badge badge-pill" style="background-color: #FA9A8F;">{{$ev->quantidade}}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @else
          <div class="accordion " id="accordionExample1">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4">
                <h5 class="card-title text-success"> <i class="fas fa-building fa-lg menu-icone"></i> Validade de Lotes em Estoque </h5>
              </div>
              <div class="card-body ">
                <p class="card-text">Parece que todos os materiais em estoque estão de acordo com as suas respectivas datas de validade.</p>
              </div>
            </div>
          </div>
        @endif

      @endif


      @if ($view['inventario']==false)

        @if ($requisicoesAbertas->count() > 0)
          <div class="accordion " id="accordionExample5">
            <div class="card mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4" style="background-color: #FFFF66;" >
                <h5 class="card-title"><i class="far fa-list-alt fa-lg menu-icone"></i>Requisições em Aberto</h5>
              </div>
              <div class="card-body " style="background-color: #FFFF99;">
                <p class="card-text"><strong>Atenção:</strong> Parece haver {{$requisicoesAbertas->count()}} novas requisicões que presisaräo ser atendidas.</p>
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                  <a class="text-muted">ver requisições...</a>
                </button>
              </div>
              <div id="collapse5" class="collapse"  data-parent="#accordionExample5">
                <ul class="list-group text-muted">
                  @foreach ($requisicoesAbertas as $req)
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                      <a href="/saida/atende/{{$req->cod_requisicao}}">Número: {{$req->cod_requisicao}} - Req.: {{$req->user->name}}</a>
                        <span class="badge badge-pill" style="background-color: #FFFF66;">{{$req->materiais_requisitados->count()}}</span>
                    </li>
                  @endforeach
                </ul>
              </div>
            </div>
          </div>
        @else
          <div class="accordion " id="accordionExample1">
            <div class="card bg-light mb-3 shadow" style="max-width: 100%;">
              <div class="card-header pt-4">
                <h5 class="card-title text-success"> <i class="far fa-list-alt fa-lg menu-icone"></i> Requisições em Aberto </h5>
              </div>
              <div class="card-body ">
                <p class="card-text">No momento não há requisições em aberto. Todas foram atendidas ou negadas.</p>
              </div>
            </div>
          </div>
        @endif

      @endif









    </div>


  </div>
</div>
@endsection
