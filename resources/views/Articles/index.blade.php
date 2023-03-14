@extends('layout') 
<html>   
   <head>
      <title>Журналы</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
   
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>
   @section('content')        
   <body>       
      <h1 align="center">Журналы</h1>       
      <table class="table">
         <tr>            
         <td>№</td>
         <td>Название</td>
         <td>Данные</td>
         </tr>         
         @foreach ($articles as $article)
         <tr> 
            <td>{{$article->id}}</td>           
            <td><a href="#">{{$article->name}}</a></td>                 
         </tr>               
         @endforeach         
      </table> 
      <div class="d-flex">
      {!! $articles->links() !!}
      </div>            
   </body>
   @endsection('content')     
</html>
