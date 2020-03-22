<!DOCTYPE html>
  <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" type="image/x-icon" href="/images/list.svg">
	
    <!-- Css Principal -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
	
    <!-- Material Icons -->
    <link rel="stylesheet" href="/assets/googlefonts/css/css.css">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
	
    <title>{{env('APP_NAME')}}</title>	
	@show
  </head>

<body>

   <div id="app">

        <v-app>

          @yield('content')
        
        </v-app>

    </div>
	
	<!-- Scripts Principal -->
    <script src="{{ mix('/js/app.js') }}"></script>

</body>
</html>
