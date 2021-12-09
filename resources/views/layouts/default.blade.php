<!doctype html>
<html lang="en">
<head>
    @include('includes.headsection')
</head>
<body>
 <div class="container">
     <header class="row">
         
         @include('includes.headerpage')
     </header>

     <div id="divContent" class="row">
  
         
         @yield('content')
     </div>

     <footer class="row">
         @include('includes.footer')
     </footer>
 </div>
</body>
</html>
