@section('lateral')     
        <div class="menu-lateral shadow-sm "  >
          <nav class="navbar navbar-expand-md navbar-light  " >
            <button  class="navbar navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

  

            <div class="collapse navbar-collapse  " id="navbarTogglerDemo03"  style="height: 100%;" >
              <ul class="d-block navbar-nav align-self-start nav-pills  " style="margin: 0 auto;" >
                <li class="nav-item">
                  <a href="/home" class="nav-link {{ asset('view') ?    $view['active'] == 'home' ? 'active' : ''    :''}} 
                    @if (Auth::user()->permission == 3)
                      disabled
                  @endif"><i class="fas fa-home fa-lg menu-icone"></i>Home</a> 
                </li>

                <li class="nav-item">
                  <a href="/local" class="nav-link {{ asset('view') ?    $view['active'] == 'local' ? 'active' : ''    :''}} 
                  @if (Auth::user()->permission == 3)
                      disabled
                  @endif" ><i class="fas fa-inbox fa-lg menu-icone"></i>Locais</a> 
                </li>

                <li class="nav-item">
                  <a href="/unidade" class="nav-link {{ asset('view') ?    $view['active'] == 'unidade' ? 'active' : ''    :''}}
                  @if (Auth::user()->permission == 3)
                      disabled
                  @endif"><i class="fas fa-ruler fa-lg menu-icone"></i>Unidades</a> 
                </li>
  

                <li class="nav-item"> 
                  <a href="/tipo" class="nav-link {{ asset('view') ?    $view['active'] == 'tipo' ? 'active' : ''    :''}} 
                  @if (Auth::user()->permission == 3)
                      disabled
                  @endif"><i class="fas fa-sitemap fa-lg menu-icone"></i>Tipos</a> 
                </li>                

                <li class="nav-item">
                  <a href="/material/consulta" class="nav-link {{ asset('view') ?    $view['active'] == 'materiais' ? 'active' : ''    :''}} 
                  @if ($view['inventario'] == true) 
                    disabled
                  @else
                    @if (Auth::user()->permission == 3)
                      disabled
                    @endif
                  @endif"><i class="fas fa-cubes fa-lg menu-icone"></i>Materiais</a>
                </li>

                <li class="nav-item"> 
                  <a href="/estoque/gerenciar" class="nav-link {{ asset('view') ?    $view['active'] == 'gerenciarEstoque' ? 'active' : ''    :''}} 
                  @if ($view['inventario'] == true) 
                    disabled
                  @else
                    @if (Auth::user()->permission == 3)
                      disabled
                    @endif
                  @endif"><i class="fas fa-building fa-lg menu-icone"></i>Estoque</a> 
                </li>

                <li class="nav-item "> 
                  <a href="/saida" class="nav-link {{ asset('view') ?    $view['active'] == 'saida' ? 'active' : ''    :''}} 
                  @if ($view['inventario'] == true) 
                    disabled
                  @else
                    @if (Auth::user()->permission == 3)
                      disabled
                    @endif
                   @endif"><i class="fas fa-dolly-flatbed fa-lg menu-icone"></i>Saída</a> 
                </li>

                <li class="nav-item"> 
                  <a href="/inventario" class="nav-link {{ asset('view') ?    $view['active'] == 'inventario' ? 'active' : ''    :''}} 
                  @if ($view['inventario'] == false) 
                    disabled
                  @else
                    @if (Auth::user()->permission == 3)
                      disabled
                    @endif
                  @endif"><i class="fas fa-check-square fa-lg menu-icone"></i>Inventário</a> 
                </li>

                <li class="nav-item"> 
                  <a href="/movimentacoes" class="nav-link {{ asset('view') ?    $view['active'] == 'movimentacoes' ? 'active' : ''    :''}} @if (Auth::user()->permission == 3) disabled @endif"><i class="fas fa-scroll fa-lg menu-icone"></i>Movimentações</a> 
                </li>

                <li class=" nav-item border border-success">
                </li>

                <li class="nav-item"  >
                  <a href="/user/gerenciar" class="nav-link {{ asset('view') ?    $view['active'] == 'gerenciarusuarios' ? 'active' : ''    :''}} @if (Auth::user()->permission != 1) disabled @endif" ><i class="fas fa-users fa-lg menu-icone" ></i>Usuários</a>

                <li class="nav-item"> 
                  <a href="/adm-inventarios" class="nav-link {{ asset('view') ?    $view['active'] == 'adm-inventarios' ? 'active' : ''    :''}}
                  @if (Auth::user()->permission != 1) disabled @endif"><i class="fas fa-check-double fa-lg menu-icone"></i>Adm. Inventários</a> 
                </li>

    
                <li class="border border-success"/>           

      

                <li class="nav-item"> 
                  <a href="/requisicao" class="nav-link {{ asset('view') ?    $view['active'] == 'requisicao' ? 'active' : ''    :''}} "><i class="far fa-list-alt fa-lg menu-icone"></i>Requisição</a> 
                </li>

                <li class="nav-item"> 
                  <a href="/minhas-requisicoes" class="nav-link {{ asset('view') ?    $view['active'] == 'minhas-requisicoes' ? 'active' : ''    :''}} "><i class="far fa-clone fa-lg menu-icone"></i>Minhas Requisições</a> 
                </li>

                <li class="nav-item"  >
                  <a href="/user/minhaconta" class="nav-link {{ asset('view') ?    $view['active'] == 'minhaconta' ? 'active' : ''    :''}} " ><i class="fas fa-user-cog fa-lg menu-icone" ></i>Minha Conta</a>
                 </li>

                 <br><br><br><br><br><br><br><br>
               </ul>

            </div> 
            

           </nav>

</div>

 
@stop