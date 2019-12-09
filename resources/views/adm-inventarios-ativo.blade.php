@extends('layouts.app')
@extends('layouts.lateral')
@section('conteudo')

@if($operacao == 'abreum')

  @foreach($inventario as $i)

    @if($loop->first)

      <div class="col-12">
        <form class="">
          <fieldset class="border shadow-sm p-3">
            <legend>Inventário Ativo:</legend>

            <div class="form-row d-flex align-items-end">

              <div class="col-sm-12 col-md-3 form-group">
                <label for="">Cód.</label>
                <input type="text" class="form-control" id="" value="{{ $i->cod_inventario }}" readonly />
              </div>

              <div class="col-sm-12 col-md-6 form-group">
                <label for="">Responsável</label>
                <input type="text" class="form-control" id="codresp" value="{{ $i->user->name }}" readonly/>
              </div>

              <div class="col-sm-12 col-md-3 form-group">
                  <label for=""> Data de Início</label>
                  <div class="input-group">
                    <input type="text" class="form-control" id="datainicio" value="{{ $i->data_inicio }}" readonly />
                  </div>
              </div>

              <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

            </div>

            <div class="form-row ">
              <div class="col-12 d-flex justify-content-around mt-4" id="">
                <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/analisa';"><i class="fas fa-check  mr-2"></i>Analisar</button>
                <button type="button" class="btn btn-lg btn-danger col-sm-5 col-md-4"  data-toggle="modal" data-target="#exampleModalCenter"> <i class="fas fa-trash mr-2"></i>Suspender</button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Suspender Inventário Ativo!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        Você tem certeza que deseja encerrar o inventário ativo? Todos os itens analisados e bem como qualquer contagem realizadas serão permanentemente excluídos do sistema.
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" data-dismiss="modal"><i class="fas fa-arrow-left mr-2"></i>Voltar</button>
                        <button type="button" class="btn btn-lg btn-danger col-sm-5 col-md-4" data-dismiss="modal" onclick="window.location.href='/adm-inventarios/suspender/{{$i->cod_inventario}}';"><i class="fas fa-trash mr-2"></i>Suspender</button>

                      </div>
                    </div>
                  </div>
                </div>



              </div>
            </div>

          </fieldset>

        </form> <!-- fim do formulário-->

        <div class="col-12 d-flex justify-content-around mt-5" id="" action="/adm-inventarios/iniciar">
          <button type="submit" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/iniciar';" disabled><i class="fas fa-plus mr-2"  ></i>Iniciar</button>
          <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/abreFormLocaliza';"><i class="fas fa-search mr-2"></i>Localizar</button>
        </div>

      </div>

    @endif

  @endforeach

@else

  <div class="col-12">
    <form class="">
      <fieldset class="border shadow-sm p-3">
      <legend>Inventário Ativo:</legend>

      <div class="form-row d-flex align-items-end">

        <div class="col-sm-12 col-md-3 form-group">
          <label for="">Cód.</label>
          <input type="text" class="form-control" id="" value="" readonly />
        </div>

        <div class="col-sm-12 col-md-6 form-group">
          <label for="">Responsável</label>
          <input type="text" class="form-control" id="" value="" readonly />
        </div>

        <div class="col-sm-12 col-md-3 form-group">
          <label for=""> Data de Início</label>
          <div class="input-group">
            <input type="date" class="form-control" id="" value="" readonly />
          </div>
        </div>

        <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

      </div>

      <div class="form-row ">
        <div class="col-12 d-flex justify-content-around mt-4" id="">
          <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/analisa';" disabled><i class="fas fa-check  mr-2"></i>Analisar</button>
          <button type="button" class="btn btn-lg btn-danger col-sm-5 col-md-4" disabled> <i class="fas fa-trash mr-2"></i>Suspender</button>
        </div>
      </div>

      </fieldset>

    </form> <!-- fim do formulário-->

      <div class="col-12 d-flex justify-content-around mt-5" id="" action="/adm-inventarios/iniciar">
        <button type="submit" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/iniciar';"><i class="fas fa-plus mr-2"  ></i>Iniciar</button>
        <button type="button" class="btn btn-lg btn-success col-sm-5 col-md-4" onclick="window.location.href='/adm-inventarios/localiza';"><i class="fas fa-search mr-2"></i>Localizar</button>
      </div>

    </div>









@endif

@endsection
