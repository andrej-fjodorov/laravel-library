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
         @foreach ($issues as $issue)
         <tr> 
            <td>{{$issue->id}}</td> 
                    
            <td>{{$issue->issueyear}}</td>
            <td>{{$issue->issuenumber}}</td>  
            <td>{{$issue->issuedate}}</td>                   
         </tr>                                
        @endforeach 
      </table> 
      <div class="d-flex">
      {!! $issues->links() !!}
      </div>           
   </body>
   @endsection('content')     
</html>
