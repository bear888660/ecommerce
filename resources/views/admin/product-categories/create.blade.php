@extends('admin.layout.admin')·
@section('subject', '產品分類管理');
@section('content')

<form action="{{route('product-categories.store')}}" method="post">
    @csrf

    @if(!empty($errors->any()))
        <div class="row col-sm-6">
            <div class="alert alert-danger">
                <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
                </ul>
            </div>
        </div>
    @endif

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">分類名稱*</label>
        <div class="col-sm-6">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{old('name')}}" placeholder="分類名稱">
        </div>
    </div>

    <div class="form-group row">
        <label for="en_name" class="col-sm-2 col-form-label">項目英文名稱*</label>
        <div class="col-md-6">
            <input type="text" name="en_name" class="form-control {{ $errors->has('en_name') ? ' is-invalid' : '' }}" id="en_name" value="{{old('en_name')}}" placeholder="項目英文名稱">
        </div>
    </div>

    <div class="form-group row">
        <label for="index_id" class="col-sm-2 col-form-label">排序*</label>
        <div class="col-md-6">
            <input type="text" name="index_id" class="form-control {{ $errors->has('index_id') ? ' is-invalid' : '' }}" id="index_id" value="{{old('index_id')}}" placeholder="排序">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">確定</button>
        <a class="btn btn-primary" href="{{route('product-categories.index')}}?{{Request::input('redirect_val')}}">返回</a>
        </div>
    </div>
    <input name="redirect_val" type="hidden" value="{{Request::input('redirect_val')}}">
</form>

@endsection
