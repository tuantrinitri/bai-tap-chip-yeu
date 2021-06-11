@extends('core::theme.layouts.default')
@section('page_content')
<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="fa fa-file-alt mr-2"></i> <span class="font-weight-semibold">Khối menu </span> - Danh sách</h4>
        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('menu.admin.create') }}" class="btn btn-primary btn-sm">Thêm khối menu</a>
        </div>
    </div>
</div>
@if (count($menus) > 0)
<div class="card table-responsive">
    <table class="table table-striped table-bordered table-hover table-td-middle">
        <thead>
            <tr>
                <th class="text-center">Khối menu</th>
                <th class="text-center">Menu trực thuộc</th>
                <th class="text-center">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($menus as $menu)
            <tr>
                <td class="text-center">
                    <a href="{{ route('menu.admin.item', $menu['id']) }}"><strong>{{ $menu['title'] }}</strong></a>
                </td>
                <td class="text-center">
                    @foreach ($menu['items'] as $item)
                    {{ $item->translate('vi', true)->title . '|'. $item->translate('en', true)->title  }},&nbsp;
                    @endforeach
                </td>
                <td class="text-center">
                    <a href="{{ route('menu.admin.edit', $menu['id'])  }}" class="text-warning mr-2" data-popup="tooltip" title="Sửa"><i class="fa fa-edit"></i></a>
                    <a href="javascript:;" onclick="askToDelete(this);return false;" data-href="{{ route('menu.admin.delete', $menu['id']) }}" class="text-danger" data-popup="tooltip" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
<div class="card-body">
    <div class="alert alert-info">
        Chưa có dữ liệu
    </div>
</div>
@endif
@endsection