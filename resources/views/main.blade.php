<!doctype html>
<html lang="en">
@include('partials.head')

  <body>

    @include('partials.nav')
    <div class="container">
      <hr>
      @include('partials.messages')
      
      @yield('content')

      <hr>
      <p class="text-center">Copyright AmineMaourid-All rights reserved</p>
    </div><!-- end of container-->

    @include('partials.script')

    @yield('scripts')

  </body>
</html>