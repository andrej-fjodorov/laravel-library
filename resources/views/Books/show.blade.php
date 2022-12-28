<html>
   
   <head>
      <title>Книжный каталог</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
   
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>  
   <body> 
      <h1 align="center">Книжный каталог</h1>       
      <table class="table">
         <tr>        
         <td>Название</td>        
         </tr>         
         @foreach ($books as $book)
         <tr>               
            <td>{{$book->name}}</td>            
         </tr>               
         @endforeach         
      </table> 
      <div class="d-flex">
      {!! $books->links() !!}
      </div>            
   </body>
</html>
