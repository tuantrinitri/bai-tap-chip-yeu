@extends('core::theme.layouts.default')
@section('page_content')
<div class="pt-3 pl-3 pr-3">
    <div class="alert alert-primary alert-sm">
        Nếu nhấp <strong>"ĐỒNG BỘ QUYỀN HẠN"</strong> mà chưa cập nhật dữ liệu mới nhất trong tệp tin cấu hình, vui lòng chuyển đến trang <a href="{{ route('core.admin.system_cache') }}" class="text-danger ml-1"><strong>QUẢN LÝ BỘ NHỚ ĐỆM</strong> <small><i class="fas fa-external-link-alt"></i></small></a>, chọn <strong>"XÓA BỘ NHỚ ĐỆM CẤU HÌNH"</strong> để cập nhật dữ liệu mới nhất.
    </div>
</div>
<div class="p-2 text-center">
    <a href="javascript:;" onclick="startSyncPermissions();" class="btn btn-warning btn-sm mr-1"><i class="icon-sync mr-1"></i> Đồng bộ quyền hạn</a>
</div>
<div id="cardContentPermission">
    <div class="card-body list_permissions pt-0">
        @foreach (get_list_permissions() as $mod)
        <div class="mb-0 rounded-0">
            <h6 class="card-title mt-3">
                <a data-toggle="collapse" class="text-default collapsed" href="#collapsible-{{ $mod['module'] }}" aria-expanded="true"><strong><i class="{{ $mod['icon'] }}"></i>&nbsp;&nbsp;{{ $mod['title'] }}</strong></a>
            </h6>

            <div id="collapsible-{{ $mod['module'] }}" class="collapse show">
                <div class="row">
                    @foreach ($mod['permissions'] as $permission)
                    <div class="col-md-3 mb-2">
                        <p class="item_permission">
                            <strong>{{ trans($permission['title']) }}</strong>
                            <br>
                            <em><small>{{ trans($permission['description']) }}</small></em>
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection

@section('custom_js')
<script>
    function startSyncPermissions(el)
    {
        var card_el = $('body');
        $(card_el).block({
            message: '<i class="icon-spinner2 spinner"></i>',
            overlayCSS: {
                backgroundColor: '#fff',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                backgroundColor: 'none'
            }
        });

        $.ajax({
            type: 'post',
            url: "{{ route('permission.admin.sync') }}",
            data: {
                _token: _token
            },
            dataType: 'JSON',
            success: function(res) {
                setTimeout(function(){
                    $(card_el).unblock();
                }, 500);
                if (res.status) {
                    $('.list_permissions').html(res.html);
                    $('.item_permission[data-popup="tooltip"]').tooltip();
                    app.showNotify(res.msg, 'success');
                } else {
                    app.showNotify(res.msg, 'error');
                }
            }
        });
    }
</script>
@endsection
