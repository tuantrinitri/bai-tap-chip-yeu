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
                    <th class="text-center">
                        <img src="{{ asset('assets/admin/images/vn.svg') }}" alt="" width="20" height="20" srcset="" class="mr-2">
                    </th>
                    <th class="text-center">
                        <img src="{{ asset('assets/admin/images/en.svg') }}" alt="" width="20" height="20" srcset="" class="mr-2">
                    </th>
                    <th class="text-center" style="width:120px">{{ trans('post::category.action') }}</th>
                    <th class="text-center" style="width  :150px">{{ trans('post::category.status') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $i => $category)
                @foreach ($category->categoryTranstion as $j => $item)
                <tr>
                    @if ($j==0)
                    <td class="text-left">{{ $item->title }}</td>
                    @else
                    <td class="text-left">{{ $item->title }}</td>
                    @endif

                    @if (count($category->categoryTranstion) == 2)
                    <td class="text-center">
                        <a href="{{ $item['locale'] == 'vi' ? route('category.admin.edit', ['lang'=> 'vi', $category['id']]) : route('category.admin.edit', ['lang'=>'vi', $category['id'] ]) }}" data-popup="tooltip" title="{{ trans('page::admin.edit') }}">
                            {!! $item['locale'] == 'vi' ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-edit" aria-hidden="true"></i>' !!}
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ $item['locale'] == 'en' ? route('category.admin.edit',['lang'=> 'en', $category['id']]) : route('category.admin.edit', ['lang'=>'en', $category['id'] ]) }}" data-popup="tooltip" title="{{ trans('page::admin.edit') }}">
                            {!! $item['locale'] == 'en' ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-edit" aria-hidden="true"></i>' !!}
                        </a>
                    </td>
                    @else
                    <td class="text-center">
                        <a href="{{ $item['locale'] == 'vi' ? route('category.admin.edit', ['lang'=> 'vi', $category['id']]) : route('category.admin.create', ['lang'=>'vi', 'category_id' =>$category['id'] ]) }}" data-popup="tooltip" title="{{ $item['locale'] == 'vi' ? trans('page::admin.edit') : trans('page::admin.add_page') }}">
                            {!! $item['locale'] == 'vi' ? '<i class="fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-plus" aria-hidden="true"></i>' !!}
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{ $item['locale'] == 'en' ? route('category.admin.edit', ['lang'=> 'en', $category['id']]) : route('category.admin.create', ['lang'=>'en', 'category_id' =>$category['id'] ]) }}" data-popup="tooltip" title="{{ $item['locale'] == 'en' ? trans('page::admin.edit') : trans('page::admin.add_page') }}">
                            {!! $item['locale'] == 'en' ? '<i class=" fa fa-check" aria-hidden="true"></i>' : '<i class="fa fa-plus" aria-hidden="true"></i>' !!}
                        </a>
                    </td>
                    @endif
                    <td class="text-center">
                        <a href="javascript:;" onclick="askToDeletePage(this);return false;" data-href="{{ route('category.admin.delete', $item['id']) }}" class="text-danger" data-popup="tooltip" title="{{ trans('page::admin.delete') }}"><i class="fas fa-trash-alt"></i></a>
                    </td>
                    @if ( $j==0)
                    <td class="text-center" rowspan="{{ count($category->categoryTranstion) }}">
                        <div class="form-check form-check-switchery form-check-switchery-sm">
                            <label class="form-check-label">
                                <input data-id="{{ $category['id'] }}" type="checkbox" class="form-input-switchery" {{ $category['status'] ? 'checked' : '' }}>
                            </label>
                        </div>
                    </td>
                    @endif
                </tr>
                @endforeach
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