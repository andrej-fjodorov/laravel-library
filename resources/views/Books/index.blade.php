@extends('layout')
<html>   
   <head>
      <title>Книжный каталог</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
   
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>  
   <body>     
      <h1 align="center">Книжный каталог</h1>
      @section('sidebar') 
      <nav class="navbar navbar-default">
         <a href="{{ route('statreleases.store') }}">Статистические сборники</a>
         <a href="{{ route('books.store') }}">Книжный каталог</a>
      @stop     
      <div class="pull-right">
                <a class="btn btn-success"  href="{{ route('books.create') }}">Добавить книгу</a>
     </div>
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
            @endforeach</td>                  
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
      <div class="d-flex">
      {!! $books->links() !!}
      </div>            
   </body>   
</html>

