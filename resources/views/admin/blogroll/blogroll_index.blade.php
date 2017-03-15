@extends('admin/base')

@section('main')

<ol class="breadcrumb">
    <li><span class="text-primary">友链管理</span></li>
    <li class="active">链接列表</li>
</ol>

<div class="container-fluid" style="margin-bottom: 15px;">
    <a href="/admin/blogroll/create" class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;添加新链接</a>
</div>

<div class="container-fluid">
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>序号</th>
                <th>标题</th>
                <th>链接地址</th>
                <th>排序值</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
        </thead>
        <tbody>
            <?php $index = ($blogrolls->currentPage() - 1) * ($blogrolls->perPage()) + 1; ?>
            @foreach ($blogrolls as $blogroll)
            <tr>
                <td>{{ $index++ }}</td>
                <td>{{ $blogroll->title }}</td>
                <td>
                    <a href="{{ $blogroll->link }}" target="blank">{{ $blogroll->link }}</a>
                </td>
                <td>{{ $blogroll->order_num }}</td>
                <td>{{ $blogroll->created_at }}</td>
                <td>
                    <a href="/admin/blogroll/{{ $blogroll->Id }}/edit" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i>&nbsp;编辑</a>
                    <a href="/admin/blogroll/{{ $blogroll->Id }}/delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>&nbsp;删除</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="pagination">

    {!! $pagination !!}

</div>

@endsection
