@extends('admin.layout.admin')

@section('subject', '管理員管理');
@section('content')

<form action="{{route('managers.store')}}" method="post">
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
        <label for="name" class="col-sm-2 col-form-label">姓名*</label>
        <div class="col-sm-6">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{old('name')}}" placeholder="姓名">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email*</label>
        <div class="col-sm-6">
            <input type="email" name="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" id="email" placeholder="Email" value="{{old('email')}}">
        </div>
    </div>

    <div class="form-group row">
        <label for="username" class="col-sm-2 col-form-label">帳號*</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="username" type="text" class="form-control " value="{{ old('username') }}" id="username" placeholder="帳號">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">密碼*</label>
        <div class="col-sm-6">
            <input autocomplete="off" name="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" placeholder="密碼">
        </div>
    </div>

    <div class="form-group row">
        <label for="password-confirm" class="col-sm-2 col-form-label">確認密碼＊</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">確定</button>
        <a class="btn btn-primary" href="{{route('managers.index')}}?{{Request::input('redirect_val')}}">返回</a>
        </div>
    </div>

    <input name="redirect_val" type="hidden" value="{{Request::input('redirect_val')}}">
</form>

@endsection
