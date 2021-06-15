@extends('core::theme.layouts.default')
@section('custom_css')
<style>
    .card-body.title {
        display: flex;
        justify-content: space-between
    }

</style>
@endsection
@section('page_content')
<div class="row ml-0 mr-0" style="border-bottom: 1px solid #ddd">
    <div class="col-md-12 p-0">
        <div class="card-body title">
            <h6 class="card-title mb-0"><strong>{{ trans('contact::admin.topic_list') }}</strong></h6>
            <a href="{{ route('contact.topic.admin.create') }}" class="btn btn-primary btn-sm">{{ trans('contact::admin.topic_create') }}</a>
        </div>
        @if (isset($listtopics) && count($listtopics) > 0)
        <div class="table-responsive">
            <table class="table table-bordered table-td-middle">
                <thead class="bg-light">
                    <tr>
                        <th class="text-center" style="width:75px">ID</th>
                        <th class="text-center" style="width:40%">{{ trans('contact::admin.topic_name') }}</th>
                        <th class="text-center" style="width: 100px">{{ trans('contact::admin.status') }}</th>
                        <th class="text-center" style="width: 150px">{{ trans('contact::admin.auto_send_mail') }}</th>
                        <th class="text-center">{{ trans('contact::admin.note') }}</th>
                        <th style="width:120px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($listtopics as $topic)
                    <tr>
                        <td class="text-center">{{ $topic['id'] }}</td>
                        <td>
                            <strong>{{ $topic['name'] }}</strong>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-check-switchery form-check-switchery-sm">
                                <label class="form-check-label">
                                    <input data-id="{{ $topic['id'] }}" type="checkbox" class="form-input-switchery form-input-switchery-1" {{ $topic['status'] ? 'checked' : '' }}>
                                </label>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="form-check form-check-switchery form-check-switchery-sm">
                                <label class="form-check-label">
                                    <input data-id="{{ $topic['id'] }}" type="checkbox" class="form-input-switchery form-input-switchery-2" {{ $topic['mail_status'] ? 'checked' : '' }}>
                                </label>
                            </div>
                        </td>
                        <td>{{ $topic['note'] }}</td>
                        <td class="text-center">
                            <a href="{{ route('contact.topic.admin.edit', $topic['id']) }}" class="text-primary ml-2" data-popup="tooltip" title="Sửa"><i class="fa fa-edit"></i></a>
                            <a href="javascript:;" onclick="askToDelete(this);return false;" data-href="{{ route('contact.topic.admin.delete', $topic['id']) }}" data-popup="tooltip" title="{{ trans('core::button.delete') }}" class="text-danger ml-2"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="alert alert-info ml-3 mr-3">
            {{ trans('contact::admin.no_data_yet') }}
        </div>
        @endif
    </div>
</div>
@endsection
@section('custom_js')
<script>
    $(document).ready(()=>{
        var switches = Array.prototype.slice.call(document.querySelectorAll('.form-input-switchery'));
        switches.forEach(function (html) {
            var switchery = new Switchery(html, {
                secondaryColor: '#d8201c'
            });
        });
        var inProcess = false;
        $(document).find('.form-input-switchery-1').each(function (i, html) {
            $(html).on('click', function(e){
                if (!inProcess) {
                    if (typeof $(this).attr('checked') !== typeof undefined) {
                        // 1 => 0
                        inProcess = true;
                        $.ajax({
                            type: 'post',
                            url: "{{ route('contact.ajax.changeStatusTopic') }}",
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
                            url: "{{ route('contact.ajax.changeStatusTopic') }}",
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
<script>
    $(document).ready(()=>{
        var switches = Array.prototype.slice.call(document.querySelectorAll('.form-input-switchery'));
        switches.forEach(function (html) {
            var switchery = new Switchery(html, {
                secondaryColor: '#d8201c'
            });
        });
        var inProcess = false;
        $(document).find('.form-input-switchery-2').each(function (i, html) {
            $(html).on('click', function(e){
                if (!inProcess) {
                    if (typeof $(this).attr('checked') !== typeof undefined) {
                        // 1 => 0
                        inProcess = true;
                        $.ajax({
                            type: 'post',
                            url: "{{ route('contact.ajax.changeStatusTopicAutoSendMail') }}",
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
                            url: "{{ route('contact.ajax.changeStatusTopicAutoSendMail') }}",
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
                                    window.location.href = res.link;
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
