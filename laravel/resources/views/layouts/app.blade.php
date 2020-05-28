<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-pjax-version" content="{{ mix('/css/app.css') . mix('/css/template.css'). mix('/js/app.js').mix('/js/template.js') }}">

    <title>   
    @if (isset($title))
     {{ config('app.name') }}|{{ $title }} 
        @else
        {{ config('app.name') }}
        @endif</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/template.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/perfect-scrollbar.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/calendar/moment.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/vendor/calendar/fullcalendar.min.js') }}" defer></script>
    <script src="{{ asset('assets/js/calendar.script.js') }}" defer></script>
    <!-- Styles -->
    <link href="{{ asset('assets/styles/vendor/calendar/fullcalendar.min.css') }}" rel="stylesheet" as="style">
    <link rel="stylesheet" href="https://unpkg.com/element-ui/lib/theme-chalk/index.css" as="style">
   <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.4.3/css/flag-icon.css" as="style">-->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" as="style">
    <link href="{{ asset('css/template.css') }}" rel="stylesheet" as="style">
    <link rel="stylesheet" href="{{ asset('assets/fonts/iconsmind/iconsmind.css')}}" as="style">
    
   
 

   
</head>
<body class="text-left">
<div class='loadscreen' id="preloader">

<div class="loader-bubble loader-bubble-primary m-5">

</div>
</div>

<div id="app" class="app-admin-wrap layout-sidebar-large clearfix">
        <div class="main-header">
            <div class="logo">
             <a href="{{url('/home')}}"><img  src="{{ asset('assets/images/reservation.png') }}" alt=""></a>
            </div>

            <div class="menu-toggle">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <div class="d-flex align-items-center">
            <i class="i-Full-Screen header-icon d-none d-sm-inline-block" data-fullscreen></i>
            
            </div>

            <div style="margin: auto"></div>

            <div class="header-part-right">
           <!-- <div class="dropdown">
            <a href="{{url('/audittrails')}}"><i class="flag-icon flag-icon-my" ></i></a>
            <span>
            <a href="{{url('/audittrails')}}"><i class="flag-icon flag-icon-gb" ></i></a>
            </span>
                </div>-->
            <div class="dropdown">
            <a href="{{url('/audittrails')}}"><i class="i-Safe-Box text-muted header-icon" ></i></a>
                    
                </div>
           
                <!-- User avatar dropdown -->
                <div class="dropdown">
                  
                    <div class="user colalign-self-end">
                        <img src="{{asset('assets/images/faces/example.jpg')}}" id="userDropdown" alt="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="hidden-xs"><strong>{{Auth::user()->name}}</strong></span>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <form method="POST" action="{{ route('logout') }}">
                            @csrf
                             <button class="dropdown-item" type="submit">Sign Out</button>
                          </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>

  <!-- Nak edit HTML, boleh edit di resources/js/components/master/HorizontalbarComponent.vue-->
  <sidebar-component v-bind:user="{{ Auth::user() }}"></sidebar-component>
  <!-- -- -->
  <div id="pjax-content" class="main-content-wrap sidenav-open d-flex flex-column">
    @yield('content')
    <br>
    <div class="flex-grow-1"></div>
  
  <div class="app-footer">
  <div class="row">
          <div class="col-md-12">
          <p class="m-0"><strong>&copy; {{ now()->year }}&nbsp;  {{ config('app.name') }}</strong></p>
          </div>
      </div>
      <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">
       
      <div class="row">
          <div class="col-md-12">
          <p>This system working in Firefox, Chrome and Safari with resolution 1024 x 768</p>
          </div>
      </div>
          </div>
      </div>
  </div>
  </div>
    
  

</div>


</body>
</html>
