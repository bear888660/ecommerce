@extends('admin.layout.admin')

@section('subject', '訂單管理');

@section('content')

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">訂單編號</label>
        <div class="col-md-6">
            {{$orderCashFlow->order_no}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">服務商</label>
        <div class="col-md-6">
            {{$orderCashFlow->provider}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">交易狀態</label>
        <div class="col-md-6">
            {{$orderCashFlow->status}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">交易碼</label>
        <div class="col-md-6">
            {{$orderCashFlow->trade_no}}
        </div>
    </div>

    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">訊息</label>
        <div class="col-md-6">
            {{$orderCashFlow->message}}
        </div>
    </div>

    <div class="form-group row">
        <div class="col-sm-10">
        <a class="btn btn-primary" href="{{URL::previous()}}">返回</a>
        </div>
    </div>

@endsection
