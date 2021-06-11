@extends('core::theme.layouts.default')

@section('page_content')
<form action="{{ route('core.admin.post_clear_cache') }}" method="post">
    {{ csrf_field() }}
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <tr>
                <td>Xóa các bộ nhớ đệm của ứng dụng: cơ sở dữ liệu, nội dung tĩnh... Chạy lệnh này khi bạn thử cập nhật dữ liệu nhưng giao diện không thay đổi</td>
                <td><button type="submit" name="btn_clear_cache" value="clear_all_cache" class="btn btn-block btn-sm btn-danger">Xóa tất cả bộ nhớ đệm</button></td>
            </tr>
            <tr>
                <td>Xóa bộ nhớ đệm giao diện giúp phần giao diện luôn mới nhất</td>
                <td><button type="submit" name="btn_clear_cache" value="clear_view_cache" class="btn btn-block btn-sm btn-primary">Xóa bộ nhớ đệm giao diện</button></td>
            </tr>
            <tr>
                <td>Bạn cần làm mới bộ đệm cấu hình khi bạn tạo ra sự thay đổi nào đó ở môi trường sản phẩm</td>
                <td><button type="submit" name="btn_clear_cache" value="clear_config_cache" class="btn btn-block btn-sm btn-primary">Xóa bộ nhớ đệm cấu hình</button></td>
            </tr>
            <tr>
                <td>Cần thực hiện thao tác này khi thấy không xuất hiện đường dẫn mới</td>
                <td><button type="submit" name="btn_clear_cache" value="clear_route_cache" class="btn btn-block btn-sm btn-primary">Xóa bộ nhớ đệm đường dẫn</button></td>
            </tr>
        </table>
    </div>
</form>
@endsection
