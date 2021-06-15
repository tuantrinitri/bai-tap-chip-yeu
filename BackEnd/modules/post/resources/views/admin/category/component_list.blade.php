<div class="card">
    <div class="card-header border-bottom mb-0 header-elements-inline">
        <h5 class="card-title">{{ trans('post::category.name') }}</h5>
    </div>
    @if (isset($categories) && count($categories))
    <div class="table-responsive">
        <table class="table">
            <thead class="bg-light">
                <tr>
                    <th>{{ trans('post::category.title') }}</th>
                    <th class="text-center" style="width:100px">{{ trans('post::category.order') }}</th>
                    <th class="text-center" style="width:150px">{{ trans('post::category.status') }}</th>
                    <th class="text-center" style="width:120px">{{ trans('post::category.action') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $cat)
                <tr>
                    {{-- <td>{{ $cat['prefix'] }} <a href="{{ route('executeSlug', $cat['slug']) }}"
                        target="_blank"><strong>{{ $cat['title'] }}</strong></a></td> --}}
                    <td><strong>{{ $cat['title'] }}</strong></td>
                    <td class="text-center">
                        <input type="number" data-id="{{ $cat['id'] }}" value="{{ $cat['order'] }}"
                            class="form-control changOrder" onchange="change_order(this);" min="0">
                    </td>
                    <td class="text-center">
                        <div class="form-check form-check-switchery form-check-switchery-sm">
                            <label class="form-check-label">
                                <input data-id="{{ $cat['id'] }}" type="checkbox" class="form-input-switchery"
                                    {{ $cat['status'] ? 'checked' : '' }}>
                            </label>
                        </div>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('category.admin.edit', $cat['id']) }}" class="text-primary"
                            data-popup="tooltip" title="{{ trans('post::category.edit_button') }}"><i
                                class="fa fa-edit"></i></a>

                        <a href="javascript:;" onclick="askToDelete(this);return false;"
                            data-href="{{ route('category.admin.delete', $cat['id']) }}" class="text-danger"
                            data-popup="tooltip" title="{{ trans('post::category.delete') }}"><i
                                class="fas fa-trash-alt"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="col-12 mt-2">
        <div class="alert alert-info">Chưa có dữ liệu</div>
    </div>
    @endif
</div>