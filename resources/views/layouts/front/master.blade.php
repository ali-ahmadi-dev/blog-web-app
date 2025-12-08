
@include('front.partials.common.header')



@include('front.partials.common.offcanvas')

<!-- =======================
TopNav START -->
@include('front.partials.common.topnav')
<!-- =======================
TopNav END -->

@yield('content')

@include('front.partials.common.profile')
@include('front.partials.common.bookmark')
@include('front.partials.index.bottomNav')
@include('front.partials.common.footer')