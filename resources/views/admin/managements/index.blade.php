@extends('admin.layout.admin')

@section('subject', '管理項目');

@section('create_btn')

    <a class="btn btn-primary" href="{{route('managements.create', ['redirect_val' => http_build_query(Request::input())])}}">新增</a>
@endsection

@section('content')
<div class="table-responsive">
    @if($managements)
        <table class="table table-striped table-sm" >
            <thead>
                <tr>
                    <th>管理項目</th>
                    <th>resource</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($managements as $management)
                    <tr>
                        <td>{{$management->name}}</td>
                        <td>{{$management->resource}}</td>
                        <td>
                            <form style="display:inline-block;margin:0" method="get" action="/admin/managements/{{$management->id}}/edit">

                                <input type="hidden" name="redirect_val" value="{{http_build_query(Request::input())}}">
                                <button class="btn btn-link btn-sm">修改</button>
                            </form>
                        </td>
                        <td>
                            <form class="del_form" style="display:inline-block;margin:0"  method="post" action="/admin/managements/{{$management->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link btn-sm">刪除</button>
                            </form>
                        </td>
                    </tr>


                @endforeach
            </tbody>
        </table>
        <div align="center">{{ $managements->appends(Request::except('page'))->links() }}</div>
    @else
    No data
    @endif
</div>
@endsection
