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
                <th width="6%"></th>
                <th width="35%"></th>
                <th width="30%"></th>
                <th width="29%"></th>
            </thread>

            <tbody>
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
                    <td></td>
                    <td>
                        <input type="submit" class="btn btn-primary" value="寄送密碼重設信件">
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
