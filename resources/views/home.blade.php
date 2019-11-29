@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="container">
    <div class="row d-flex wrap">


<div class="col-md-6 ">
@if (count($materiaisAbaixoEstoqueSeg) > 0)
    <div class="accordion " id="accordionExample1">

    <div class="card bg-warning mb-3 shadow" style="max-width: 100%;">
        <div class="card-body ">
            <h5 class="card-title">Estoque de Segurança Atingido</h5>     
            
            <p class="card-text"><strong>Atenção:</strong> {{count($materiaisAbaixoEstoqueSeg)}} materiais parecem ter atingido o estoque de segurança e exigem a sua atenção.</p>

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
              <a class="text-muted">ver materias...</a>
            </button>            
        </div>
        <div id="collapse1" class="collapse"  data-parent="#accordionExample1">
            <ul class="list-group text-muted">
                @foreach ($materiaisAbaixoEstoqueSeg as $maes)
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                      <a href="/material/aloca/{{$maes->cod_material}}">{{$maes->nome_material}}</a>
                      <span class="badge badge-warning badge-pill">{{$maes->estoque_total}} de {{$maes->estoque_seg}} </span>
                    </li>
                @endforeach
            </ul>  
        </div>
    </div>
</div>
@endif



@if (count($materiaisAbaixoEstoqueMin) > 0)
<div class="accordion " id="accordionExample2">

    <div class="card bg-danger mb-3 text-light shadow" style="max-width: 100%;">
        <div class="card-body ">
            <h5 class="card-title">Estoque Mínimo Atingido</h5>
            <p class="card-text"><strong>Atenção:</strong> {{count($materiaisAbaixoEstoqueMin)}} materiais parecem ter atingido o estoque mínimo e exigem a sua atenção urgente!</p>
                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                  <a class="text-light">ver materias...</a>
                </button>            
        </div>
        <div id="collapse2" class="collapse"  data-parent="#accordionExample2">
            <ul class="list-group text-muted">
                @foreach ($materiaisAbaixoEstoqueMin as $maem)
                    <li class="list-group-item d-flex justify-content-between align-items-center ">
                      <a href="/material/aloca/{{$maes->cod_material}}">{{$maem->nome_material}}</a>
                      <span class="badge badge-danger badge-pill">{{$maem->estoque_total}} de {{$maem->estoque_min}} </span>
                    </li>
                @endforeach
            </ul> 
        </div>
    </div>
</div>
@endif


@if (Auth::user()->permission == 1)
  @if ($usuariosSemPermissao->count() > 0)
  <div class="accordion" id="accordionExample4">

      <div class="card bg-secondary mb-3 shadow" style="max-width: 100%;">
          <div class="card-body text-light">
              <h5 class="card-title">Permissão para novos usuários </h5>  
              <p class="card-text">Parece que {{ $usuariosSemPermissao->count() }} novos usuários se registraram no sistema e precisam da sua autorização de acesso.</p>

                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                    <a class="text-light">Ver usuários...</a>
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
  @endif
@endif







</div>

























<div class="col-md-6 ">

  @if ($estoquesVencidos->count() > 0)
    <div class="accordion " id="accordionExample3">

    <div class="card bg-danger mb-3 text-light shadow" style="max-width: 100%;">
        <div class="card-body ">
            <h5 class="card-title">Materiais Vencidos</h5>
            <p class="card-text"><strong>Atenção:</strong> {{$estoquesVencidos->count()}} lotes parecem estar com a data de validade vencida e exigem a sua atenção.</p>

                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                  <a class="text-light">ver lotes...</a>
                </button>            
        </div>
        <div id="collapse3" class="collapse"  data-parent="#accordionExample3">
          <ul class="list-group text-muted">
          @foreach ($estoquesVencidos as $ev)
              <li class="list-group-item d-flex justify-content-between align-items-center ">
                <a href="/estoque/ajusta/{{$ev->id}}">{{$ev->material->nome_material}} (Local: {{$ev->local->nome_local}} )</a>
                <span class="badge badge-danger badge-pill">{{$ev->quantidade}}</span>
              </li>
            @endforeach
                </ul>  
        </div>
    </div>
</div>
@endif
  

   @if ($requisicoesAbertas->count() > 0)
    <div class="accordion " id="accordionExample5">

    <div class="card bg-warning mb-3 shadow" style="max-width: 100%;">
        <div class="card-body ">
            <h5 class="card-title">Requisicões não atendidas</h5>
            <p class="card-text"><strong>Atenção:</strong> Parece haver {{$requisicoesAbertas->count()}} novas requisicões que presisaräo ser atendidas.</p>

                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse5" aria-expanded="true" aria-controls="collapse5">
                  <a class="text-muted">ver requisições...</a>
                </button>            
        </div>
        <div id="collapse5" class="collapse"  data-parent="#accordionExample5">
          <ul class="list-group text-muted">
          @foreach ($requisicoesAbertas as $req)
              <li class="list-group-item d-flex justify-content-between align-items-center ">
                <a href="">Número: {{$req->cod_requisicao}} - Req.: {{$req->user->name}}</a>
                <span class="badge badge-warning badge-pill">{{$req->materiais_requisitados->count()}}</span>
              </li>
            @endforeach
                </ul>  
        </div>
    </div>
</div>
@endif
</div>



 






     


    </div>
</div>
@endsection
