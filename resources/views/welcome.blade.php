@extends('layouts.app')


@section('conteudoCentralizado')

	<div class="container " style="height: 100vh;">
	    <div class="row text-center mt-5">
	        <h1 style="margin: auto;">Bem-vindo ao Sistema de Almoxarifado!</h1>
	    </div>




	

		    @if (  Auth::check())
	@if (  Auth::user()->permission == null  ) 
<div class="row d-flex justify-content-center " >
	<div class="col-md-6">
		<div class="card mt-5">
	        <div class="card-header bg-danger text-light">Você não tem autorização!</div>
	        <div class="card-body">
	            Você ainda não possui autorização. Aguarde até o coodernador atribuir um nível de permissão ao seu usuário.
	        </div>
	    </div>
		
	</div>
		    
	
</div>

	@endif
@endif



</div>

@endsection



     