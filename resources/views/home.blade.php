@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

<div class="container">
    <div class="row">

<div class="col-md-6">
    <div class="accordion" id="accordionExample1">

    <div class="card bg-warning mb-3 shadow" style="max-width: 100%;">
        <div class="card-body ">
            <h5 class="card-title">Estoque de Segurança Atingido</h5>     
            
            <p class="card-text"><strong>Atenção:</strong> 4 materiais parecem ter atingido o estoque de segurança e exigem a sua atenção.</p>

            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
              <a class="text-muted">ver materias...</a>
            </button>            
        </div>
        <div id="collapse1" class="collapse"  data-parent="#accordionExample1">
    
                <ul class="list-group">
                  <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <a href="">Macacão eletricista tamanho GG</a>
                    <span class="badge badge-warning badge-pill">14</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Uniforme Camiseta Branca tamanho M</a>
                    <span class="badge badge-warning badge-pill">2</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Óculos de Proteção Modelo KT</a>
                    <span class="badge badge-warning badge-pill">1</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Porca Sextavada M8 DIN 934 </a>
                    <span class="badge badge-warning badge-pill">1</span>
                  </li>
                </ul>  
        </div>
    </div>
</div>



<div class="accordion " id="accordionExample2">

    <div class="card bg-danger mb-3 text-light shadow" style="max-width: 100%;">
        <div class="card-body ">
            <h5 class="card-title">Estoque Mínimo Atingido</h5>
            <p class="card-text"><strong>Atenção:</strong> 4 materiais parecem ter atingido o estoque mínimo e exigem a sua atenção urgente!</p>
                <button class="btn btn-link " type="button" data-toggle="collapse" data-target="#collapse2" aria-expanded="true" aria-controls="collapse2">
                  <a class="text-light">ver materias...</a>
                </button>            
        </div>
        <div id="collapse2" class="collapse"  data-parent="#accordionExample2">
    
                <ul class="list-group text-muted ">
                  <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <a href="">Parafuso Allen sem Cabeça M12x16</a>
                    <span class="badge badge-danger badge-pill">14</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Uniforme Camiseta Branca temanho M</a>
                    <span class="badge badge-danger badge-pill">2</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Óculos de Proteção Modelo KT</a>
                    <span class="badge badge-danger badge-pill">1</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Porca Sextavada M8 DIN 934 </a>
                    <span class="badge badge-danger badge-pill">1</span>
                  </li>
                </ul>  
        </div>
    </div>
</div>
    
</div>







<div class="col-md-6">
    <div class="accordion" id="accordionExample3">

    <div class="card bg-danger mb-3 text-light shadow" style="max-width: 100%;">
        <div class="card-body ">
            <h5 class="card-title">Materiais Vencidos</h5>
            <p class="card-text"><strong>Atenção:</strong> 2 lotes parecem estar com a data de validade vencida e exigem a sua atenção.</p>

                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse3" aria-expanded="true" aria-controls="collapse3">
                  <a class="text-light">ver lotes...</a>
                </button>            
        </div>
        <div id="collapse3" class="collapse"  data-parent="#accordionExample3">
    
                <ul class="list-group text-muted">
                  <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <a href="">Óleo Mineral 15W50</a>
                    <span class="badge badge-danger badge-pill">14</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Reagente químico 583CRB Oftmol</a>
                    <span class="badge badge-danger badge-pill">2</span>
                  </li>
                </ul>  
        </div>
    </div>
</div>



<div class="accordion " id="accordionExample4">

    <div class="card bg-secondary mb-3 shadow" style="max-width: 100%;">
        <div class="card-body text-light">
            <h5 class="card-title">Permissão para novos usuários </h5>  
            <p class="card-text">Parece que 3 novos usuários se registraram no sistema e precisam da sua autorização de acesso.</p>

                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse4" aria-expanded="true" aria-controls="collapse4">
                  <a class="text-light">Ver usuários...</a>
                </button>            
        </div>
        <div id="collapse4" class="collapse"  data-parent="#accordionExample4">
    
                <ul class="list-group text-muted">
                  <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <a href="">Geovane Viana de Oliveira</a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Mariana Fogaça</a>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="">Gustavo Pereira da Silva</a>
                  </li>
                </ul>  
        </div>
    </div>
</div>
    
</div>


     


    </div>
</div>
@endsection
