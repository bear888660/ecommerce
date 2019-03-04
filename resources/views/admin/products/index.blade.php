@extends('admin.layout.admin')

@section('subject', '產品管理');

@section('create_btn')

    <a class="btn btn-primary" href="{{route('products.create', ['redirect_val' => http_build_query(Request::input())])}}">新增</a>
@endsection

@section('content')
<div class="table-responsive">
    @if($products)
        <table class="table table-striped table-sm" >
            <thead>
                <tr>
                    <th>類別</th>
                    <th>產品名稱</th>
                    <th>價格</th>
                    <th>排序</th>
                    <th>修改</th>
                    <th>刪除</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{$product->category->name}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->index_id}}</td>
                        <td>
                            <form style="display:inline-block;margin:0" method="get" action="/admin/products/{{$product->id}}/edit">
                                <input type="hidden" name="redirect_val" value="{{http_build_query(Request::input())}}">
                                <button class="btn btn-link btn-sm">修改</button>
                            </form>
                        </td>
                        <td>
                            <form class="del_form" style="display:inline-block;margin:0"  method="post" action="/admin/products/{{$product->id}}">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-link btn-sm">刪除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div align="center">{{ $products->appends(Request::except('page'))->links() }}</div>
    @else
    No data
    @endif
</div>
@endsection
