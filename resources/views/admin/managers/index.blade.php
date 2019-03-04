@extends('admin.layout.admin')

@section('subject', '管理員管理');

@section('create_btn')
    <a class="btn btn-primary" href="{{route('managers.create', ['redirect_val' => http_build_query(Request::input())])}}">新增</a>
@endsection

@section('content')
<div class="table-responsive">
    @if($managers)
        <table class="table table-striped table-sm" >
            <thead>
                <tr>
                    <th>姓名</th>
                    <th>信箱</th>
                    <th>帳號</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($managers as $manager)
                    <tr>
                        <td>{{$manager->name}}</td>
                        <td>{{$manager->email}}</td>
                        <td>{{$manager->username}}</td>
                        <td>
                            <form style="display:inline-block;margin:0" method="get" action="/admin/managers/{{$manager->id}}/edit">
                                <input type="hidden" name="redirect_val" value="{{http_build_query(Request::input())}}">
                                <button class="btn btn-link btn-sm">修改</button>
                            </form>
                        </td>
                        <td>
                            <form class="del_form" style="display:inline-block;margin:0"  method="post" action="/admin/managers/{{$manager->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link btn-sm">刪除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div align="center">{{ $managers->appends(Request::except('page'))->links() }}</div>
    @else
    No data
    @endif
</div>
@endsection
