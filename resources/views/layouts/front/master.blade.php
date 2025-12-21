
@include('front.partials.common.header')


@auth
    @include('front.partials.common.offcanvas')
@endauth



@include('front.partials.common.topnav')


@yield('content')

@auth()
@include('front.partials.common.profile')
@include('front.partials.common.bookmark')
@endauth

@include('front.partials.index.bottomNav')
@include('front.partials.common.footer')
