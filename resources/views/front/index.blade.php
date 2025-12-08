

	@extends('layouts.front.master')
	<!-- **************** MAIN CONTENT START **************** -->

	@section('content')

	<main>

		@include('front.partials.index.trendingNews')
		@include('front.partials.index.dailyNews')
		@include('front.partials.index.category-swiper')
		@include('front.partials.index.hot-news')
		@include('front.partials.index.latest-videos')
		@include('front.partials.index.tech-news-slider')
		@include('front.partials.index.sports-news-slider')
		@include('front.partials.index.editor-choice-slider')
	</main>

	@endsection
<!-- **************** MAIN CONTENT END **************** -->

