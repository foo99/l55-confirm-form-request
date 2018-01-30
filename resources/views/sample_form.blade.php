<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
</head>
<body>
    
    @if(session('status') === 'success')
    
        <p>ありがとうございました。</p>
    
    @else 
    
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <div class="panel panel-default">
            <div class="panel-heading">
                <h1 class="panel-title">フォーム</h1>
            </div>
                
            <div class="panel-body">
                {!! Form::open(['url' => '/', 'method' => 'post']) !!}
                    <input type="hidden" name="_confirm" value="{{ old('_confirm', 'false') }}">
                    <div class="form-group required {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label" for="name">お名前</label>
                        
                        @if(old('_confirm', 'false') === 'false')
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        @else
                            <p class="form-control-static">{{ old('name') }}</p>
                            <input type="hidden" name="name" value="{{ old('name') }}">
                        @endif
                        
                        @if($errors->has('name'))
                            <p class="help-block">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group text-center">
                        @if(old('_confirm', 'false') === 'false')
                            <button type="submit" class="btn btn-primary">確認</button>
                        @else
                            <button type="submit" name="_action" value="back" class="btn btn-default">戻る</button>
                            <button type="submit" name="_action" value="post" class="btn btn-primary">送信</button>
                        @endif
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    
    @endif
    
    
        
    </body>
</html>
    