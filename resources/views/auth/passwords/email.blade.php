@extends('front.layouts.front')

@section('title', 'Home')
@section('content')

<section class="text-center">
            <br/>
            <br/>
</section>
<div class="row text-left">

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <table class="table">
            <thread>
                <th colspan="4">
                    @if (session('status'))
                        <font color="red">
                            {{ session('status') }}
                        </font>
                    @endif
                </th>
            </thread>

            <tbody>
                <tr>
                    <td width="6%">
                         <label for="email" class="col-md-4 col-form-label text-md-right">E-mail</label>
                    </td>
                    <td width="35%">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                @if ($errors->has('email'))
                                    <font color="red">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </font>
                                @endif
                    </td>
                    <td width="30%"></td>
                    <td width="29%"></td>
                </tr>
            </tbody>
        </table>
        <div align="left"><input type="submit" class="btn btn-primary button" value="寄送密碼重設信件"></div>
    </form>
</div>
<section class="text-center">
            <br/>
            <br/>
            <br/>
            <br/>
</section>

@endsection
