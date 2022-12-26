<head>
      <title>Редактировать книгу</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
   
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>   
   <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Добавить книгу</h3>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Заголовок:</strong>
                    <input type="text" name="name" class="form-control" value="{{$book->name}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дополнительный заголовок:</strong>
                    <input type="text" name="additionalname" class="form-control" value="{{$book->additionalname}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Сведения об ответственности:</strong>
                    <input type="text" name="response" class="form-control" value="{{$book->response}}">
                </div>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дополнительное сведение об ответственности:</strong>
                    <input type="text" name="additionalresponse" class="form-control" value="{{$book->additionalresponse}}">
                </div>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Место издания:</strong>
                    <input type="text" name="publishplace" class="form-control" value="{{$book->publishplace}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Издательство:</strong>
                    <input type="text" name="publishhouse" class="form-control" value="{{$book->publishhouse}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Год издания:</strong>
                    <input type="text" name="publishyear" class="form-control" value="{{$book->publishyear}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Том:</strong>
                    <input type="text" name="tom" class="form-control" value="{{$book->tom}}">
                </div>
            </div>             
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Количество страниц:</strong>
                    <input type="text" name="pages" class="form-control"  value="{{$book->pages}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Авторский знак:</strong>
                    <input type="text" name="authorsign" class="form-control"  value="{{$book->authorsign}}">
                </div>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Инвентарный номер:</strong>
                    <input type="text" name="code" class="form-control"  value="{{$book->code}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Номер СК:</strong>
                    <input type="text" name="numbersk" class="form-control"  value="{{$book->numbesk}}">
                </div>
            </div>                   
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дата поступления:</strong>
                    <input type="text" name="recieptdate" class="form-control"  value="{{$book->recieptdate}}">
                </div>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Рубрика:</strong>
                    <input type="text" name="rubriс" class="form-control"  value="{{$book->rucric_id}}">
                </div>
            </div>       
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Цена:</strong>
                    <input type="text" name="cost" class="form-control"  value="{{$book->cost}}">
                </div>
            </div>     
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ISBN:</strong>
                    <input type="text" name="ISBN" class="form-control"  value="{{$book->ISBN}}">
                </div>
            </div>     
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Аннотация:</strong>
                    <input type="text" name="annotation" class="form-control"  value="{{$book->annotation}}">
                </div>
            </div>       
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Списано:</strong>
                    <input type="text" name="withraw" class="form-control"  value="{{$book->withraw}}">
                </div>
            </div>                                                             
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Сохранить изменения</button>
            </div>
        </div>

    </form>

