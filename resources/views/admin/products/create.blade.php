@extends('admin.layout.admin')·
@section('subject', '產品管理');
@section('content')

<form action="{{route('products.store')}}" enctype="multipart/form-data" method="post">
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
        <label for="name" class="col-sm-2 col-form-label">產品分類*</label>
        <div class="col-md-6">
            <select name="category_id" id="category_id" class="form-control {{ $errors->has('category_id') ? ' is-invalid' : '' }}"  >
                <option>請選擇</option>
                @foreach ($product_categories as $category)
                    @if (old('category_id') === $category->id)
                        <option selected value="{{$category->id}}">{{$category->name}}</option>
                    @else
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endif
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">產品名稱*</label>
        <div class="col-md-6">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{old('name')}}" placeholder="產品名稱">
        </div>
    </div>

    <div class="form-group row">
        <label for="en_name" class="col-sm-2 col-form-label">產品英文名稱*</label>
        <div class="col-md-6">
            <input type="text" name="en_name" class="form-control {{ $errors->has('en_name') ? ' is-invalid' : '' }}" id="en_name" value="{{old('en_name')}}" placeholder="產品英文名稱">
        </div>
    </div>

    <div class="form-group row">
        <label for="price" class="col-sm-2 col-form-label">價格*</label>
        <div class="col-md-6">
            <input type="text" name="price" class="form-control {{ $errors->has('price') ? ' is-invalid' : '' }}" id="price" value="{{old('price')}}" placeholder="價格">
        </div>
    </div>

    <div class="form-group row">
        <label for="is_hot" class="col-sm-2 col-form-label">顯示首頁*</label>
        <div class="col-md-6">
            @if( old('is_hot') === 'true' )
                <input type="checkbox" checked value="true" name="is_hot" id="is_hot">
            @else
                <input type="checkbox" value="true" name="is_hot" id="is_hot">
            @endif
        </div>
    </div>

    <div class="form-group row">
        <label for="description" class="col-sm-2 col-form-label">簡述</label>
        <div class="col-md-6">
            <textarea  name="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}" id="description">{{old('description')}}</textarea>
        </div>
    </div>

    <div class="form-group row">
        <label for="index_id" class="col-sm-2 col-form-label">排序*</label>
        <div class="col-md-6">
            <input type="text" name="index_id" class="form-control {{ $errors->has('index_id') ? ' is-invalid' : '' }}" id="index_id" value="{{old('index_id')}}" placeholder="排序">
        </div>
    </div>

    <div class="form-group row">
        <label for="index_id" class="col-sm-2 col-form-label">圖片</label>
        <div class="col-md-6">
            <label for="image">上傳圖片</label>
            <input type="file" class="form-control-file" name="image" id="image">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">確定</button>
        <a class="btn btn-primary" href="{{route('products.index')}}?{{Request::input('redirect_val')}}">返回</a>
        </div>
    </div>
    <input name="redirect_val" type="hidden" value="{{Request::input('redirect_val')}}">
</form>

@endsection
