@extends('admin.layout.admin')

@section('subject', '產品分類管理');

@section('create_btn')

    <a class="btn btn-primary" href="{{route('product-categories.create', ['redirect_val' => http_build_query(Request::input())])}}">新增</a>
@endsection

@section('content')
<div class="table-responsive">
    @if($product_categories)
        <table class="table table-striped table-sm" >
            <thead>
                <tr>
                    <th>分類名稱</th>
                    <th>排序</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($product_categories as $product_category)
                    <tr>
                        <td>{{$product_category->name}}</td>
                        <td>{{$product_category->index_id}}</td>
                        <td>
                            <form style="display:inline-block;margin:0" method="get" action="/admin/product-categories/{{$product_category->id}}/edit">

                                <input type="hidden" name="redirect_val" value="{{http_build_query(Request::input())}}">
                                <button class="btn btn-link btn-sm">修改</button>
                            </form>
                        </td>
                        <td>
                            <form class="del_form" style="display:inline-block;margin:0"  method="post" action="/admin/product-categories/{{$product_category->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link btn-sm">刪除</button>
                            </form>
                        </td>
                    </tr>


                @endforeach
            </tbody>
        </table>
        <div align="center">{{ $product_categories->appends(Request::except('page'))->links() }}</div>
    @else
    No data
    @endif
</div>
@endsection
