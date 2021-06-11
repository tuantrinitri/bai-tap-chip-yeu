@extends('core::theme.layouts.default')
@section('page_content')
    @if (count($banners) > 0)
        <div class="table-responsive">
            <table class="table datatable-basic">
                <thead>
                    <tr>
                        <th class="text-center" style="width:100px;">Hình ảnh</th>
                        <th class="text-center" style="width:350px;">Tiêu đề</th>
                        <th class="text-center" style="width:200px;">Bắt đầu</th>
                        <th class="text-center" style="width:200px;">Kết thúc</th>
                        <th class="text-center" style="width:150px;">Trạng thái</th>
                        <th class="text-center" style="width:250px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($banners as $banner)
                        <tr>
                            <td class="text-center" style="word-break:break-word"><img
                                    src="{{ isset($banner['file_src']) ? asset($banner['file_src']) : '' }}" width="50px"
                                    height="50px"> </td>
                            <td class="text-center" style="word-break:break-word">{{ $banner['title'] }}</td>
                            <td class="text-center" style="word-break:break-word">
                                {{ $banner['begin_time'] ? date('d/m/Y', strtotime($banner['begin_time'])) : 'Vô thời hạn' }}
                            </td>
                            <td class="text-center" style="word-break:break-word">
                                {{ $banner['expired_time'] ? date('d/m/Y', strtotime($banner['expired_time'])) : 'Vô thời hạn' }}
                            </td>
                            <td class="text-center">{!! $banner['status'] ? '<span class="text-success"><i class="fa fa-check"></i></span>' : '<span class="text-danger"><i class="fa fa-close"></i></span>' !!}</td>
                            <td class="text-center">
                                <a href="{{ route('banner.admin.edit', $banner['id']) }}"
                                    class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Sửa</a>
                                <a href="javascript:;" onclick="askToDelete(this); return false;"
                                    data-href="{{ route('banner.admin.delete', $banner['id']) }}"
                                    class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Xóa</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if ($banners->links('vendor.pagination.bootstrap-4'))
            <div class="cms-paginate float-right mr-3">
                {{ $banners->links('vendor.pagination.bootstrap-4') }}
            </div>
        @endif
    @else
        <div class="alert alert-info">Chưa có dữ liệu</div>
    @endif
@endsection
