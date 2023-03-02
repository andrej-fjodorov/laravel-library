@extends('layout')
<html>   
   <head>
      <title>Книжный каталог</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
      <script>
         function resetSearch() {
            let searchInput = document.getElementById("searchInput");
            searchInput.value = null;
            searchInput.closest("form").submit();
         }
      </script>  
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>  
   <body>     
      <h1 align="center">Книжный каталог</h1>
      @section('content')      
      <div class="pull-right">
                <a class="btn btn-success"  href="{{ route('books.create') }}">Добавить книгу</a>
     </div> 
     <form action="" method="GET">
      @csrf
      <input id="searchInput" type="text" name="search" value="{{request('search')}}" required/>
      <button type="submit">Найти</button>
      <input type="button" onclick="resetSearch()" value="Сбросить">
  </form>
      <table class="table">
         <tr>            
         <td>№</td>
         <td>Название</td>
         <td>Данные</td>
         </tr>         
         @foreach ($books as $book)         
         <tr> 
            <td>@foreach($book->authors as $author)
            {{ $author->surname }}  {{ $author->name }}.  {{ $author->middlename }}.
            @endforeach                 
            <td><a href="#">{{$book->name}}</a></td>
            <td>{{$book->publishplace}}, {{$book->publishyear}}.- {{$book->pages}}c. {{$book->title}}           
            <td><a href="storage{{$book->filepath}}">{{$book->filename}}</a></td>
            </td>
            <td><a  href="{{ route('books.edit', $book->id) }}">Редактировать</a><td>  
            <td>
               <form action="{{ route('books.destroy', $book->id)}}" method="post">  
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger">Удалить</button>
               </form>
            <td>                
         </tr>               
         @endforeach           
      </table> 
      Найдено записей: {{$books->total()}}
      <div class="d-flex">
      {!! $books->links() !!}
      </div>
      @endsection('content')          
   </body>   
</html>

