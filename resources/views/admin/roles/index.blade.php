@extends('admin.layout.admin')

@section('subject', '角色管理');

@section('create_btn')
    
    <a class="btn btn-primary" href="{{route('roles.create')}}">新增</a>
@endsection

@section('content')
<div class="table-responsive">
    @if($roles)
        <table class="table table-striped table-sm" >
            <thead>
                <tr>
                    <th>名稱</th>
                    <th width="70%">管理項目</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->name}}</td>
                        <td>
                            
                            @foreach ($role->managements as $management)
                                {{$management->name}}，       
                            @endforeach
                            
                        </td>
                        <td>
                            <form style="display:inline-block;margin:0" method="get" action="/admin/roles/{{$role->id}}/edit">
                                <button class="btn btn-link btn-sm">修改</button>
                            </form>
                        </td>
                        <td>
                            <form style="display:inline-block;margin:0"  method="post" action="/admin/roles/{{$role->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link btn-sm">刪除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
    No data
    @endif
</div>
@endsection