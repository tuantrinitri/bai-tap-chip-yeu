@extends('core::theme.layouts.default')
@section('page_content')
<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="far fa-newspaper mr-2"></i> <span
                class="font-weight-semibold">{{ trans('post::post.name') }}</span> -
            {{ trans('post::category.name') }}</h4>
        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
</div>
<div class="card-body">
    <div class="row">
        <div class="col-xl-4">
            @include('post::admin.category.component_edit')
        </div>
        <div class="col-xl-8">
            @include('post::admin.category.component_list')
        </div>
    </div>
</div>
@endsection
@section('custom_js')
<script>
   function get_slug(elTitle, elSlug) {
    $.ajax({
        type: "post",
        url: "{{ route('get-slug') }}",
        data: {
            _token: _token,
            plainText: $(elTitle).val()
        },
        dataType: "JSON",
        success: function (data) {
            $(elSlug).val(data);
        }
    });
}
</script>
<script>
    function change_order(el)
        {
            var id = $(el).data('id');
            var order = $(el).val();
            if(order >= 0) {
                // call ajax to chang order
                $(document).find('.changOrder').attr('disabled', 'disabled');
                $.ajax({
                    type: 'post',
                    url: "{{ route('category.ajax.order') }}",
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
            } else {
                alert('Không hợp lệ');
            }
        }
        $(document).ready(()=>{
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
                                url: "{{ route('category.ajax.status') }}",
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
                                url: "{{ route('category.ajax.status') }}",
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
</script>
@endsection