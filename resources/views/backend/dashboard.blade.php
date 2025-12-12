

	@extends('layouts.backend.master')
	

	@section('content')

	<main>

		<section class="py-4">

			<div class="container">
				<div class="row g-4">


					@include('backend.partials.index.statistics')
					@include('backend.partials.index.chart')
					@include('backend.partials.index.viewsStatistic')
					@include('backend.partials.index.newsList')


				</div>
			
			</div>


		<section>	
	</main>

	@endsection


