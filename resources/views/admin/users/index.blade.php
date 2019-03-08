@extends('admin.layout.admin')

@section('subject', '會員管理');

@section('content')
<div class="table-responsive">
    @if($users)
        <table class="table table-striped table-sm" >
            <thead>
                <tr>
                    <th>姓名</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->stock}}</td>
                        <td>{{$user->price}}</td>
                        <td>{{$user->index_id}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div align="center">{{ $users->appends(Request::except('page'))->links() }}</div>
    @else
    No data
    @endif
</div>
@endsection
