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
         @foreach ($journals as $journal)
         <tr> 
            <td>{{$journal->id}}</td>           
            <td><a href="">{{$journal->name}}</a></td>
            <td>{{$journal->ISSN}}</td>           
         </tr>               
         @endforeach         
      </table> 
      <div class="d-flex">
      {!! $journals->links() !!}
      </div>            
   </body>
   @endsection('content')     
</html>
