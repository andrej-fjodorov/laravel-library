@extends('layout') 
<html>   
   <head>
      <title>Выпуски журналов</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
   
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>
   @section('content')        
   <body>       
      <h1 align="center">Выпуски журналов</h1>       
      <table class="table">
         <tr>            
         <td>№</td>
         <td>Название</td>
         <td>Данные</td>
         </tr>         
         
         <tr>            
            <td><b>Год издания {{$issues->issueyear}}<b></td>
            <td><b>Выпуск {{$issues->issuenumber}}</b></td>  
            <td><b>Дата поступления {{$issues->issuedate}}</b></td>                    
         </tr>      
      </table>
      @foreach($issues->articles as $article)
      <p>{{ $article->name }}
      @foreach($article->authors as $author) 
      <b>{{$author->surname}}. {{$author->name}}. {{$author->middlename}}.</b>       
      @endforeach
      {{$article->pages}}
      @endforeach
      </p>                        
   </body>
   @endsection('content')     
</html>
