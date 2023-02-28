<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <!-- Bootstrap CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="/css/bootstrap-icons.css">
    
    <!-- My css -->
    <link rel="stylesheet" href="/css/style.css">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="/img/gunz.png" style="border-radius: 50%; overflow:hidden;">

    @if(isset($title))
      @if($title == "home" || $title == "Home" )
        <title>Welcome to G-Blog</title>
      @else
        <title>{{ $title }} | G-Blog</title>
      @endif
    @else
      <title>G-Blog</title>
    @endif
</head>
<body>
    @include('partials.navbar')

    <div class="container mt-4">
      @yield('container')
    </div>

    <script src="/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>