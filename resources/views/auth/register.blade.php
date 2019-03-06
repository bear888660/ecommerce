@extends('front.layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <table class="table">
            <thread>
                <th width="6%"></th>
                <th width="35%"></th>
                <th width="30%"></th>
                <th width="29%"></th>
            </thread>
            <tbody>
                <tr>
                    <td><label for="name" class="col-md-4 col-form-label text-md-right">姓名</label></td>
                    <td>
                      <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <font color="red">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </font>
                            @endif
                    </td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                    </td>
                    <td>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <font color="red">
                                <strong>{{ $errors->first('email') }}</strong>
                            </font>
                        @endif
                    </td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td><label for="password" class="col-md-4 col-form-label text-md-right">密碼</label></td>
                    <td>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                        @if ($errors->has('password'))
                            <font color="red">
                                <strong>{{ $errors->first('password') }}</strong>
                            </font>
                        @endif
                    </td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td>
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-right">確認密碼</label>
                    </td>
                    <td>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td></td>
                    <td>
                        <input type="submit" class="btn btn-sm btn-default" value="註冊會員">
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<section class="text-center">
            <br/>
            <br/>
            <br/>
            <br/>
</section>

@endsection
