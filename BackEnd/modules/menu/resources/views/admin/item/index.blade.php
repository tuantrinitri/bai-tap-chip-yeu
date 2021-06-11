@extends('core::theme.layouts.default')
@section('page_content')
<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="fa fa-file-alt mr-2"></i> <span class="font-weight-semibold"> Menu </span> - Danh mục</h4>
        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href="{{ route('item.admin.create', $menu['id']) }}" class="btn btn-primary btn-sm">Thêm menu</a>
        </div>
    </div>
</div>
@if (count($items) > 0)
<div class="card table-responsive">
    <table class="table table-striped table-bordered table-hover table-td-middle">
        <thead>
            <tr>
                <th class="text-center" style="width:100px">Thứ tự</th>
                <th class="text-center">Tiêu đề</th>
                <th class="text-center">Đường dẫn liên kết</th>
                <th class="text-center">Hiển thị</th>
                <th class="text-center"> Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
            {{-- @dd($item->translate('vi',true)->title) --}}
            <tr>
                <td class="text-center">
                    <select data-min="{{ $minOrder }}" data-max="{{ $maxOrder }}" data-order="{{ $item['order'] }}" data-id="{{ $item['id'] }}" class="form-control changOrderPage"></select>
                </td>
                <td class="text-center">
                    <a href="{{ route('menu.admin.item', $menu['id']) }}?parent_id={{ $item['id'] }}"><strong>{{ $item->translate('vi', true)->title. ' | '.$item->translate('en', true)->title  }}</strong></a>
                    @if ($item['numsubmenu'] > 0)
                    ({{ $item['numsubmenu'] }} menu con)
                    @endif
                </td>
                <td class="text-center">{{ $item['link'] }}</td>
                <td class="text-center">
                    <div class="form-check form-check-switchery form-check-switchery-sm">
                        <label class="form-check-label">
                            <input data-id="{{ $item['id'] }}" type="checkbox" class="form-input-switchery" {{ $item['status'] ? 'checked' : '' }}>
                        </label>
                    </div>
                </td>
                <td class="text-center">
                    <a href="{{ route('item.admin.edit', $item['id'])  }}" class="text-warning mr-2" data-popup="tooltip" title="Sửa"><i class="fa fa-edit"></i></a>
                    <a href="javascript:;" onclick="askToDelete(this);return false;" data-href="{{ route('item.admin.delete', $item['id']) }}" class="text-danger" data-popup="tooltip" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
@section('custom_js')
<script>
    function setSwitchery(switchElement, checkedBool) {
        if((checkedBool && !switchElement.isChecked()) || (!checkedBool && switchElement.isChecked())) {
            switchElement.setPosition(true);
            switchElement.handleOnchange(true);
        }
    }
    $(document).ready(function(){
        $('.uniform-checker').click(function (e) {
            if ($(this).find('input[type="checkbox"]').hasClass('all')) {
                $('input[type="checkbox"].form-check-input-styled:not(.all)').prop('checked', !$(this).find('span').first().hasClass('checked'));
            } else {
                if ($(this).find('span').first().hasClass('checked'))
                    $('.selectAll .uniform-checker .form-check-input-styled').prop('checked', false);
                else {
                    if ($('.uniform-checker span:not(.checked)').length == $('.uniform-checker').length - 1)
                        $('.selectAll .uniform-checker .form-check-input-styled').prop('checked', true);
                }
            }
            $.uniform.update();
        });
       
        var switches = Array.prototype.slice.call(document.querySelectorAll('.form-input-switchery'));
        switches.forEach(function (html) {
            var switchery = new Switchery(html, {
                secondaryColor: '#d8201c'
            });
        });
        var inProcess = false;
        $(document).find('.form-input-switchery').each(function (i, html) {
            $(html).on('click', function(e){
                if (!inProcess) {
                    if (typeof $(this).attr('checked') !== typeof undefined) {
                        // 1 => 0
                        inProcess = true;
                        $.ajax({
                            type: 'post',
                            url: "{{ route('item.ajax.changeStatus') }}",
                            data: {
                                _token: _token,
                                id: $(this).data('id'),
                                status: 0
                            },
                            dataType: 'JSON',
                            success: function(res) {
                                inProcess = false;
                                if (res.status) {
                                    $(html).removeAttr('checked');
                                    app.showNotify(res.msg, 'success');
                                } else {
                                    app.showNotify(res.msg, 'error');
                                    setTimeout(function(){
                                        var newEl = new Switchery(html, {
                                            secondaryColor: '#d8201c'
                                        });
                                        setSwitchery(newEl, true);
                                    }, 200);
                                }
                            }
                        });
                    }
                    if (typeof $(this).attr('checked') === typeof undefined) {
                        // 0 => 1
                        inProcess = true;
                        $.ajax({
                            type: 'post',
                            url: "{{ route('item.ajax.changeStatus') }}",
                            data: {
                                _token: _token,
                                id: $(this).data('id'),
                                status: 1
                            },
                            dataType: 'JSON',
                            success: function(res) {
                                inProcess = false;
                                if (res.status) {
                                    $(html).attr('checked', 'checked');
                                    app.showNotify(res.msg, 'success');
                                } else {
                                    app.showNotify(res.msg, 'error');
                                    setTimeout(function(){
                                        var newEl = new Switchery(html, {
                                            secondaryColor: '#d8201c'
                                        });
                                        setSwitchery(newEl, false);
                                    }, 200);
                                }
                            }
                        });
                    }
                } else {
                    e.preventDefault();
                }
            });
        });
    });
    $('.changOrderPage').each(function() {
        var min = $(this).data('min');
        var max = $(this).data('max');
        var selected = $(this).data('order');
        var id = $(this).data('id');
        var html = '';
        for (var i = min; i <= max; i++) {
            html += '<option value="' + i + '" ' + (i == selected ? 'selected' : '') + '>' + i + '</option>';
        }
        $(this).attr('onchange', 'change_order(this);return false;');
        $(this).html(html);
    });

    function change_order(el)
    {
        var id = $(el).data('id');
        var order = $(el).val();
        // call ajax to chang order
        $(document).find('.changOrderPage').attr('disabled', 'disabled');
        $.ajax({
            type: 'post',
            url: "{{ route('item.admin.ajaxChangeOrderMenuItem') }}",
            data: {
                _token: _token,
                id: id,
                order: order
            },
            dataType: 'JSON',
            success: function(data) {
                window.location.reload();
            }
        });
    }

</script>
@endsection