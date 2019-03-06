@extends('front.layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">
    <form method="POST" action="{{ route('password.update') }}">
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
                    <td>
                        <input type="hidden" name="token" value="{{ $token }}">
                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                    </td>
                    <td>
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
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
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </td>
                    <td></td>
                    <td></td>
                </tr>



        <div class="form-group row">


            <div class="col-md-6">

            </div>
        </div>

        <div class="form-group row">


            <div class="col-md-6">

            </div>
        </div>

        <div class="form-group row">
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
            </div>
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </div>
    </form>
        </div>
    </div>
        </div>
    </div>
</div>
@endsection
