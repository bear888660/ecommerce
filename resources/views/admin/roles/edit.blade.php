@extends('admin.layout.admin')

@section('subject', '角色管理');

@section('content')

<form>
    @csrf
    @method('PATCH')
    
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">姓名*</label>
        <div class="col-sm-10">
            <input type="text" name="name" class="form-control is-invalid" id="name" placeholder="姓名">
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-sm-2 col-form-label">Email*</label>
        <div class="col-sm-10">
            <input type="email" name="email" class="form-control" id="email" placeholder="Email">
        </div>
    </div>

    <div class="form-group row">
        <label for="userame" class="col-sm-2 col-form-label">帳號*</label>
        <div class="col-sm-10">
            <input autocomplete="off" name="userame" type="text" class="form-control" id="userame" placeholder="帳號">
        </div>
    </div>

    <div class="form-group row">
        <label for="password" class="col-sm-2 col-form-label">密碼*</label>
        <div class="col-sm-10">
            <input autocomplete="off" name="password" type="password" class="form-control" id="password" placeholder="密碼">
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
        <button type="submit" class="btn btn-primary">確定</button>
        <button type="button" class="btn btn-primary" onclick="location='/admin/managers'">返回</button>
        </div>
    </div>
</form>

@endsection