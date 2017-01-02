<!DOCTYPE html>
<html lang="en">
<head>

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Encrypted CSRF token for Laravel, in order for Ajax requests to work --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>
      {{ isset($title) ? $title.' - '.config('backpack.base.project_name').' ' : config('backpack.base.project_name') }}
    </title>

    <meta name="description" content="{{ $meta_description }}">
    <link rel="canonical" href="{{ Request::url() }}" />
    

    @yield('before_styles')

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <!-- <link rel="stylesheet" href="{{ asset('vendor/adminlte/') }}/bootstrap/css/bootstrap.min.css"> -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
    <!-- BackPack Base CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/backpack/backpack.base.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/jasny-bootstrap/css/jasny-bootstrap.min.css') }}">

    <!-- bower:css -->
    <link rel="stylesheet" href="{{ URL::to('/') }}/bower_components/owl.carousel/dist/assets/owl.carousel.css" />
    <link rel="stylesheet" href="{{ URL::to('/') }}/bower_components/video.js/dist/video-js.css" />
    <!-- endbower -->

    <link rel="stylesheet" href="{{  url('/') }}/css/main.css?version=2.1.7" />

    @yield('after_styles')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>
<body>

<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '296363624084064',
      xfbml      : true,
      version    : 'v2.8'
    });
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>

<!-- Google Tag Manager -->
@php
$gtm = HeaderTemplate::getGTM();
@endphp
<noscript><iframe src="//www.googletagmanager.com/ns.html?id={{ $gtm }}"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','{{ $gtm }}');</script>
<!-- End Google Tag Manager -->

    @include('elements.header')

    @if(Request::path() !== '/')
        @include('elements.breadcrumb')
    @endif    

    <!-- Site wrapper -->

    @include('elements.banners')

      <!-- <div class="container">
        <div class="row"> -->
          @yield('content')
        <!-- </div>
      </div> -->
    <!-- ./wrapper -->


     @include('elements.footer')

    @yield('before_scripts')

    <!-- jQuery 2.2.0 -->
    <!-- <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script> -->
    <script>window.jQuery || document.write('<script src="{{ asset('vendor/adminlte') }}/plugins/jQuery/jQuery-2.2.0.min.js"><\/script>')</script>
    <!-- Bootstrap 3.3.5 -->
    <!-- <script src="{{ asset('vendor/adminlte') }}/bootstrap/js/bootstrap.min.js"></script> -->
    <script src="{{ asset('vendor/adminlte') }}/dist/js/app.min.js"></script>
    <script type="text/javascript">
        // To make Pace works on Ajax calls
        $(document).ajaxStart(function() { Pace.restart(); });

        // Ajax calls should always have the CSRF token attached to them, otherwise they won't work
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

        // Set active state on menu element
        var current_url = "{{ url(Route::current()->getUri()) }}";
        $("ul.sidebar-menu li a").each(function() {
          if ($(this).attr('href').startsWith(current_url) || current_url.startsWith($(this).attr('href')))
          {
            $(this).parents('li').addClass('active');
          }
        });
    </script>


    @yield('after_scripts')

    <!-- JavaScripts -->
    
    <!-- bower:js -->
    <script src="{{ URL::to('/') }}/bower_components/modernizr/modernizr.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/jquery/dist/jquery.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/owl.carousel/dist/owl.carousel.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/jquery-validation/dist/jquery.validate.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/video.js/dist/video.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/get-size/get-size.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/ev-emitter/ev-emitter.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/desandro-matches-selector/matches-selector.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/fizzy-ui-utils/utils.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/outlayer/outlayer.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/masonry/dist/masonry.pkgd.min.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/matchHeight/dist/jquery.matchHeight.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/headroom.js/dist/headroom.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/headroom.js/dist/headroom.min.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/headroom.js/dist/jQuery.headroom.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/headroom.js/dist/jQuery.headroom.min.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/headroom.js/dist/angular.headroom.js"></script>
    <script src="{{ URL::to('/') }}/bower_components/headroom.js/dist/angular.headroom.min.js"></script>
    <!-- endbower -->

    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

    <script src="{{ asset('vendor/jasny-bootstrap/js/jasny-bootstrap.min.js') }}"></script>
    <script src="{{  url('/') }}/js/all.js?version=2.0"></script>

</body>
</html>
