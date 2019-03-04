@extends('admin.layout.admin')

@section('subject', '角色管理');

@section('content')

<form action="{{route('roles.store')}}" method="post">
    @csrf
    

    @if(!empty($errors->first()))
        <div class="row col-sm-6">
            <div class="alert alert-danger">
                <span>{{ $errors->first() }}</span>
            </div>
        </div>
    @endif
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">名稱*</label>
        <div class="col-sm-6">
            <input type="text" name="name" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" value="{{old('name')}}" placeholder="名稱">
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">管理項目*</label>
        <div class="col-sm-6">
        @foreach($managements as $management)
    <div class="form-check">

        @if ( is_array(old('managements')) && in_array($management->id, old('managements')) )
            <input class="form-check-input" name="managements[]" checked type="checkbox" value="{{$management->id}}" id="managements">
        @else 
            <input class="form-check-input" name="managements[]" type="checkbox" value="{{$management->id}}" id="managements">
        @endif
        <label class="form-check-label" for="managements">
           {{$management->name}}
        </label>
    </div>
    @endforeach

        </div>
    </div>



    <div class="form-group row">
        <div class="col-sm-6">
        <button type="submit" class="btn btn-primary">確定</button>
        <a class="btn btn-primary" href="{{route('roles.index')}}">返回</a>
        </div>
    </div>
</form>

@endsection