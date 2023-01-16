<html>
<head>
    <title>Электронный каталог - @yield('title')</title>
</head>
<body>  
  <div class="container">
    <nav class="navbar navbar-default">
      <a href="{{ route('statreleases.store') }}">Статистические сборники</a>
      <a href="{{ route('books.store') }}">Книжный каталог</a>    
    </nav>
  </div> 
  @yield('content')
</body>
</html>