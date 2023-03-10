@extends('layout')
<head>
      <title>Статистические сборники</title>
      <script src="{{ asset('js/app.js') }}" defer></script>
   
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   </head>
   @section('content')        
   <div class="row" style="margin-bottom: 20px;">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h3>Редактировать статистический сборник</h3>
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

    <form action="{{ route('statreleases.store') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Заголовок:</strong>
                    <input type="text" name="name"  class="form-control" value="{{$statrelease->name}}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дополнительный заголовок:</strong>
                    <input type="text" name="additionalname" class="form-control" value="{{$statrelease->additionalname}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Сведения об ответственности:</strong>
                    <input type="text" name="response" class="form-control" value="{{$statrelease->response}}">
                </div>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Место издания:</strong>
                    <input type="text" name="publishplace" class="form-control" value="{{$statrelease->publishplace}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Год издания:</strong>
                    <input type="text" name="publishyear" class="form-control" value="{{$statrelease->publishyear}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Рубрика:</strong>
                    <input type="text" name="rubric" class="form-control" value="{{$statrelease->rubric_id}}">
                </div>
            </div>       
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Количество страниц:</strong>
                    <input type="text" name="pages" class="form-control" value="{{$statrelease->pages}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Дата поступления:</strong>
                    <input type="text" name="recieptdate" class="form-control" value="{{$statrelease->recieptdate}}">
                </div>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Цена:</strong>
                    <input type="text" name="cost" class="form-control" value="{{$statrelease->cost}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Регистрационный номер:</strong>
                    <input type="text" name="code" class="form-control" value="{{$statrelease->code}}">
                </div>
            </div> 
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Авторский знак:</strong>
                    <input type="text" name="authorsign" class="form-control" value="{{$statrelease->authorsign}}">
                </div>
            </div>  
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Номер СК:</strong>
                    <input type="text" name="numbersk" class="form-control" value="{{$statrelease->numbersk}}">
                </div>
            </div>                                          
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-success">Добавить</button>
            </div>
        </div>
        @endsection('content')     
    </form>

