@extends('front.layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
    <form method="POST" action="{{ route('login') }}">
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
                    <td><label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label></td>
                    <td> <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
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
                    <td>
                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                    </td>
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

                    </td>
                    <td>
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                                記住我
                        </label>
                <input type="submit" class="btn btn-sm btn-default" value="登入">

                <a class="btn btn-primary" href="{{ route('register') }}">
                    註冊會員
                </a>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        忘記密碼?
                    </a>
                @endif
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
