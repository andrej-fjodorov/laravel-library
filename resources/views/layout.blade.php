<html>
<head>
    <title>Электронный каталог - @yield('title')</title>
</head>
<body>
    @section('sidebar')
    <nav class="navbar navbar-default">
      <a href="{{ route('statreleases.store') }}">Статистические сборники</a>
      <a href="{{ route('books.store') }}">Книжный каталог</a>
    @show  
</body>
</html>