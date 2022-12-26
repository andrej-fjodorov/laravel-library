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
         <td>№</td>
         <td>Название</td>
         <td>Данные</td>
         </tr>         
         @foreach ($books as $book)
         <tr> 
            <td>{{$book->id}}</td>           
            <td><a href="#">{{$book->name}}</a></td>
            <td>{{$book->publishplace}}, {{$book->publishyear}}.- {{$book->pages}}c.({{$book->title}})</td>
            <td><a  href="{{ route('books.edit',$book->id) }}">Редактировать</a><td>  
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
