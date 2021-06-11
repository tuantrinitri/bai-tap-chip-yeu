@extends('core::theme.layouts.default')
@section('page_content')
<div class="page-header-content header-elements-md-inline">
    <div class="page-title d-flex">
        <h4><i class="far fa-newspaper mr-2"></i> <span class="font-weight-semibold">{{ trans('post::post.name') }}</span> - {{ trans('post::post.list') }}</h4>
        <a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
    </div>
    <div class="header-elements d-none">
        <div class="d-flex justify-content-center">
            <a href=""></a>
            <a href="{{ route('post.admin.create') }}" class="btn btn-primary btn-sm">{{ trans('post::post.add_post') }}</a>
        </div>
    </div>
</div>
{{-- <div class="card-header border-bottom mb-0 header-elements-inline p-0">
    <div class="text-center" style="margin-top: 20px!important;width: 100%;padding-left: 10px;padding-right: 10px;">
        <form action="#" method="GET">
            <div class="row">
                <div class="col-12 col-md-6 mt-1">
                    <div class="form-group">
                        <input type="text" placeholder="{{ trans('post::post.search') }}" class="form-control" name="title" value="{{ isset($param['title']) ? $param['title'] : '' }}">
</div>
</div>
<div class="col-12 col-md-2 mt-1">
    <div class="form-group">
        <select class="form-control" name="categoryId">
            <option value="-1" {{ (isset($param['category_id']) ? $param['category_id'] : -1) == -1 ? 'selected' : '' }}>
                {{ trans('post::category.all') }}</option>
            @foreach($categories as $iCat)
            @foreach ($iCat['category_transtion'] as $item)
            <option value="{{$item['id']}}" {{ (old('categoryId', isset($param['categoryId']) ? $param['categoryId'] : '') == $item['id']) ? 'selected' : '' }}>
                {{ isset($item['prefix']) ?? '' }} {{ $item['title'] }}</option>
            @endforeach
            @endforeach
        </select>
    </div>
</div>
<div class="col-12 col-md-2 mt-1 mb-1">
    <button type="submit" class="btn btn-info"><i class="fas fa-filter mr-2"></i></button>
    <a href="{{ route('post.admin.index') }}" class="btn btn-warning"><i class="fas fa-trash-restore-alt"></i></a>
</div>
</div>
</form>
</div>
</div> --}}

@if (isset($posts) && count($posts) > 0)
<div class="table-responsive">
    <table class="table table-td-middle" id="post-list-table" style="font-size:13px">
        <thead>
            <tr>
                <th>{{ trans('post::post.title') }}</th>
                <th class="text-center">{{ trans('post::post.category') }}</th>
                <th class="text-center"><i class="fa fa-eye"></i></th>
                <th class="text-center">
                    <img src="{{ asset('assets/admin/images/vn.svg') }}" alt="" width="20" height="20" srcset="" class="mr-2">
                </th>
                <th class="text-center">
                    <img src="{{ asset('assets/admin/images/en.svg') }}" alt="" width="20" height="20" srcset="" class="mr-2">
                </th>
                <th class="text-center">{{ trans('post::post.status') }}</th>
                <th style="width:100px;">{{ trans('post::post.action') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $i => $post)
            @foreach ($post->postTranlastion as $j => $item)
            <tr>
                <td>
                    <strong><a href="{{ route('post.web.post', $post['slug']) }}" target="_blank">{{ Str::limit($item['title'], 40) }}</a></strong>
                </td>
                @if($item['locale'] == 'vi')
                <td class="text-center">{{ $post->category->title }}</td>
                @else
                <td class="text-center">{{ $post->category->translate('en')->title }}</td>
                @endif

                <td class="text-center">{{ $post['totalhits'] }}</td>
                @if (count($post->postTranlastion) == 2)
                <td class="text-center">
                    <a href="{{ $item['locale'] == 'vi' ? route('post.admin.edit', ['lang'=> 'vi', $post['id']]) : route('post.admin.edit', ['lang'=>'vi', $post['id'] ]) }}" data-popup="tooltip" title="{{ trans('post::post.edit') }}">
                        {!! $item['locale'] == 'vi' ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-edit" aria-hidden="true"></i>' !!}
                    </a>
                </td>
                <td class="text-center">
                    <a href="{{ $item['locale'] == 'en' ? route('post.admin.edit',['lang'=> 'en', $post['id']]) : route('post.admin.edit', ['lang'=>'en', $post['id'] ]) }}" data-popup="tooltip" title="{{ trans('post::post.edit') }}">
                        {!! $item['locale'] == 'en' ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-edit" aria-hidden="true"></i>' !!}
                    </a>
                </td>
                @else
                <td class="text-center">
                    <a href="{{ $item['locale'] == 'vi' ? route('post.admin.edit', ['lang'=> 'vi', $post['id']]) : route('post.admin.create', ['lang'=>'vi', 'post_id' =>$post['id'] ]) }}" data-popup="tooltip" title="{{ $item['locale'] == 'vi' ? trans('post::post.edit') : trans('post::post.add_post') }}">
                        {!! $item['locale'] == 'vi' ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-plus" aria-hidden="true"></i>' !!}
                    </a>
                </td>
                <td class="text-center">
                    <a href="{{ $item['locale'] == 'en' ? route('post.admin.edit', ['lang'=> 'en', $post['id']]) : route('post.admin.create', ['lang'=>'en', 'post_id' =>$post['id'] ]) }}" data-popup="tooltip" title="{{ $item['locale'] == 'en' ? trans('post::post.edit') : trans('post::post.add_post') }}">
                        {!! $item['locale'] == 'en' ? '<i class=" fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-plus" aria-hidden="true"></i>' !!}
                    </a>
                </td>
                @endif
                <td class="text-center">
                    <span style="display:none;">{{ $post['status'] }}</span>
                    <div class="form-check form-check-switchery form-check-switchery-sm">
                        <label class="form-check-label">
                            <input data-id="{{ $post['id'] }}" type="checkbox" class="form-input-switchery" {{ $post['status'] ? 'checked' : '' }}>
                        </label>
                    </div>
                </td>
                <td class="text-center">
                    <a href="javascript:;" onclick="askToDelete(this);return false;" data-href="{{ route('post.admin.delete', $item['id']) }}" class="text-danger" data-popup="tooltip" title="{{ trans('post::post.delete') }}"><i class="fas fa-trash-alt"></i></a>
                </td>
            </tr>
            @endforeach

            @endforeach
        </tbody>
    </table>
    @if ($posts->links('vendor.pagination.bootstrap-4'))
    <div class="cms-paginate float-right mr-3">
        {{ $posts->links('vendor.pagination.bootstrap-4') }}
    </div>
    @endif
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
<script src="{{asset('assets/admin/js/plugins/tables/datatables/datatables.min.js')}}"></script>
<script>
    $(document).ready( function () {
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
                            url: "{{ route('post.admin.status') }}",
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
                            url: "{{ route('post.admin.status') }}",
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