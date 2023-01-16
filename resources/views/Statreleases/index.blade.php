@extends('layout') 
<html>   
   <head>
      <title>Статистические сборники</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
   
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>
   @section('content')        
   <body>       
      <h1 align="center">Статистические сборники</h1> 
      <div class="pull-right">
         <a class="btn btn-success"  href="{{ route('statreleases.create') }}">Добавить сборник</a>
      </div>        
      <table class="table">
         <tr>            
         <td>№</td>
         <td>Название</td>
         <td>Данные</td>
         </tr>         
         @foreach ($statreleases as $statrelease)
         <tr> 
            <td>{{$statrelease->id}}</td>           
            <td><a href="#">{{$statrelease->name}}</a></td>
            <td>{{$statrelease->publishplace}}, {{$statrelease->publishyear}}.- {{$statrelease->pages}}c.({{$statrelease->title}})</td>
            <td><a  href="{{ route('statreleases.edit',$statrelease->id) }}">Редактировать</a><td>  
            <td>
               <form action="{{ route('statreleases.destroy', $statrelease->id)}}" method="post">  
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger">Удалить</button>
               </form>
            <td>  
         </tr>               
         @endforeach         
      </table> 
      <div class="d-flex">
      {!! $statreleases->links() !!}
      </div>            
   </body>
   @endsection('content')     
</html>
