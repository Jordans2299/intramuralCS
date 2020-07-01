{{-- 
    sources:
    https://www.youtube.com/watch?v=AL8PCThJ9c4&t=1s
    
     --}}
     <!doctype html>
     <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
     <head>
         <meta charset="utf-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
     
         <!-- CSRF Token -->
         <meta name="csrf-token" content="{{ csrf_token() }}">
     
         <title>
            Intramural CS
         </title>
         <link rel="stylesheet" href="{{asset('css/imcs.css')}}">
         <link rel="stylesheet" href="{{asset('css/app.css')}}">
         <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
         <!-- TinyMCE Editor -->
         <script src='https://cdn.tiny.cloud/1/el4r9zdh32q8w2zsx94l69x8xo71dc1wuc338511nh2m9yht/tinymce/5/tinymce.min.js' referrerpolicy="origin"></script>
         <script>
             tinymce.init({
             selector: '#post_body'
             });
         </script>
     </head>
     <body>
            <div class="navBar">
                     <div class="siteName">
                         <a href="/" id="logo"><i class="fas fa-network-wired"></i></a>
                         <a href="/" id="title">Intramural CS</a>
                     </div>
                     <div class="links">
                         <a href="/resources" id="schools">Resources</a>
                         <a href="/topics" id="courses">Topics</a>
                         <a href="/posts" id="posts">Forum</a>
                     </div>
                     <div class="linksDrop">
                         <button id="linkBtn" onclick="linkDropDown()" class="linkBtn">More <i class="fas fa-caret-down"></i></button>
                         <div class="linkDropContent" id="linkDropContent">
                             <a href="/resources">Resources</a>
                             <a href="/topics">Topics</a>
                             <a href="/posts">Forum</a>
                         </div>
                     </div>
                     @guest
                         <a class="account" id="login" href="{{ route('login') }}">{{ __('Login') }}</a>
                     {{-- @if (Route::has('register')) --}}
                             <a class="account" id="signup" href="{{ route('register') }}">{{ __('Register') }}</a>
                    
                
                     <div class="accountDrop">
                             <button id="accountBtn" onclick="accountDropDown()" class="accountBtn"><i class="fas fa-bars"></i></button>
                             <div class="accountDropContent" id="accountDropContent">
                                     
                                    <a class="nav-link" id="login" href="{{ route('login') }}">{{ __('Login') }}</a>
                                     {{-- @if (Route::has('register')) --}}
                                    <a class="nav-link" id="signup" href="{{ route('register') }}">{{ __('Register') }}</a>
                                 
                             </div>
                         </div> 
                    @else
                    <div class="logoutDrop">
                        
                        <button id="logoutBtn" onclick="logoutDropDown()" class="logoutBtn"><span><div id="divProfImg"><img src="/storage/images/{{Auth::user()->image}}" alt="" id="navProfImg"></div>{{ Auth::user()->name }}  <i class="fas fa-caret-down"></i></span></button>
                        <div class="logoutDropContent" id="logoutDropContent">
                            <a href="/home">Dashboard</a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                        </div>
                    </div>
                    
                    @endguest
                 </div>
                 @include('inc.messages')
                 @yield('content')
             </body>
             <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
             <script type="text/javascript" src="{{ URL::asset('js/imcs.js') }}"></script>
         </html> 
     
     