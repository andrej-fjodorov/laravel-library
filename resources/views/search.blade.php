<head>
    <title>Книжный каталог</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
 
 <!-- Styles -->
 <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
 </head> 
 <!--<form action="" method="GET" role="search">
    {{ csrf_field() }}
    <div class="input-group">
        <input type="text" class="form-control" name="search"
            placeholder="Поиск по автору"> <span class="input-group-btn">
            <button type="submit" class="btn btn-default">
                <span class="bi bi-arrow-clockwise"></span>
            </button>
        </span>
    </div>
</form>--> 
<form action="" method="GET">
    @csrf
    <input type="text" name="search" value="{{request('search')}}"  onclick="FormReset()" required/>
    <button type="submit">Найти</button>
    <button type="reset" onclick="resetForm()">Сбросить</button>
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
        </td>                
    </tr>      
    @endforeach           
 </table> 
 Найдено записей: {{$books->total()}}
 <div class="d-flex">
    {!!$books->links()!!}
</div>
 