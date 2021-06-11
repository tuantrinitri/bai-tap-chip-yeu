<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('post::category.edit') }} #{{ $category_edit['id'] }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('category.admin.edit', $category_edit['id']) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $category_edit['id'] }}">
            <div class="form-group">
                <label><strong>{{ trans('post::category.parent_cat') }}</strong></label>
                <select name="parent_id" class="form-control">
                    <option value="0">-- {{ trans('post::category.parent') }} --</option>
                    @if (isset($categories) && count($categories))
                    @foreach ($categories as $cat)
                    @if ($category_edit['id'] != $cat['id'])
                    <option value="{{ $cat['id'] }}" {{ old('parent_id', $category_edit['parent_id']) == $cat['id'] ? 'selected' : '' }}>
                        {{ $cat['prefix'] }} {{ $cat['title'] }}
                    </option>
                    @endif
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.title') }}</strong> <sup class="text-danger">(∗)</sup></label>
                <input name="title" id="txtTitle" type="text" class="form-control" placeholder="{{ trans('post::category.title') }}" value="{{ old('title', $transtion['title']) }}">
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.slug') }}</strong> <sup class="text-danger">(∗)</sup></label>
                <div class="input-group">
                    <input placeholder="{{ trans('post::category.slug') }}" id="txtSlug" type="text" class="form-control" name="slug" value="{{ old('slug', $category_edit['slug']) }}">
                    <div class="input-group-prepend mr-0">
                        <a href="javascript:;" onclick="get_slug('#txtTitle', '#txtSlug');" class="btn btn-dark btn-sm"><em class="fa fa-sync"></em></a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.image') }}</strong></label>
                <div class="input-group areaBrowserFile">
                    <input placeholder="{{ trans('post::category.image') }}" readonly type="text" id="cat-image" class="form-control" name="image" value="{{ old('image', $category_edit['image']) }}">
                    <div class="input-group-prepend mr-0">
                        <button class="btn btn-light btn-sm btn-remove-file text-danger" type="button"><i class="fa fa-times"></i></button>
                        <button class="btn btn-dark btn-sm btn-choose-file" data-id="cat-image" type="button"><i class="fa fa-image mr-1"></i>{{ trans('post::category.image') }}</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.description') }}</strong></label>
                <textarea name="description" class="form-control" placeholder="{{ trans('post::category.description') }}" rows="3">{{ old('description', $transtion['description']) }}</textarea>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3"><strong>{{ trans('post::category.locale') }}</strong> <sup class="text-danger">(*)</sup></label>
                <div class="col-lg-9">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <div class="uniform-choice">
                                <div class="uniform-choice" aria-disabled="">
                                    <input name="locale" type="radio" class="form-check-input-styled lang" {{ isset($transtion['locale']) && $transtion['locale'] != 'vi' ? 'disabled' : '' }} {{ isset($transtion['locale']) && $transtion['locale'] =='vi' ? 'checked' : '' }} value="vi">
                                </div>
                            </div>
                            <img src="{{ asset('assets/admin/images/vn.svg') }}" alt="" width="20" height="20" srcset="">
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <div class="uniform-choice">
                                <div class="uniform-choice">
                                    <input name="locale" type="radio" class="form-check-input-styled lang" {{ isset($transtion['locale']) && $transtion['locale'] =='en' ? 'checked' : '' }} {{ isset($transtion['locale']) && $transtion['locale'] != 'en' ? 'disabled' : '' }} value="en">
                                </div>
                            </div>
                            <span class="text-danger"><img src="{{ asset('assets/admin/images/en.svg') }}" alt="" width="20" height="20" srcset=""></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3"><strong>{{ trans('post::category.status')  }}</strong></label>
                <div class="col-lg-9">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <div class="uniform-choice">
                                <div class="uniform-choice">
                                    <input name="status" type="radio" class="form-check-input-styled" {{ old('status', $category_edit['status']) == 1 ? 'checked' : '' }} value="1">
                                </div>
                            </div>
                            <span class="text-success">{{ trans('post::category.active')  }}</span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <div class="uniform-choice">
                                <div class="uniform-choice">
                                    <input name="status" type="radio" class="form-check-input-styled" {{ old('status', $category_edit['status']) == 0 ? 'checked' : '' }} value="0">
                                </div>
                            </div>
                            <span class="text-danger">{{ trans('post::category.deactive')  }}</span>
                        </label>
                    </div>
                </div>
            </div>

            {{-- <hr>
            <a data-toggle="collapse" class="text-default collapsed" href="#collapsible-seo" aria-expanded="true">
                <h6><strong><i class="fab fa-google mr-2"></i>{{ trans('post::category.seo_setting')  }}</strong></h6>
            </a>
            <div id="collapsible-seo" class="collapse">
                <div class="form-group">
                    <label><strong>{{ trans('post::category.seo_title') }}</strong></label>
                    <input name="seo_title" type="text" class="form-control" placeholder="{{ trans('post::category.seo_title') }}" value="{{ old('seo_title', $category_edit['seo_title']) }}">
                </div>
                <div class="form-group">
                    <label><strong>{{ trans('post::category.seo_description') }}</strong></label>
                    <input name="seo_description" type="text" class="form-control" placeholder="{{ trans('post::category.seo_description') }}" value="{{ old('seo_description', $category_edit['seo_description']) }}">
                </div>
                <div class="form-group">
                    <label><strong>{{ trans('post::category.seo_keywords') }}</strong></label>
                    <input name="seo_keywords" type="text" class="form-control" placeholder="{{ trans('post::category.seo_keywords') }}" value="{{ old('seo_keywords', $category_edit['seo_keywords']) }}">
                </div>
                <div class="form-group">
                    <label><strong>{{ trans('post::category.seo_image') }}</strong></label>
                    <div class="input-group areaBrowserFile">
                        <input placeholder="{{ trans('post::category.seo_image') }}" readonly type="text" id="seo-image" class="form-control" name="seo_image" value="{{ old('seo_image', $category_edit['seo_image']) }}">
                        <div class="input-group-prepend mr-0">
                            <button class="btn btn-light btn-sm btn-remove-file text-danger" type="button"><i class="fa fa-times"></i></button>
                            <button class="btn btn-dark btn-sm btn-choose-file" data-id="seo-image" type="button"><i class="fa fa-image mr-1"></i>{{ trans('post::category.seo_image') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr> --}}
            <div class="float-right">
                <a href="{{ route('category.admin.index') }}" class="btn btn-dark btn-sm">{{ trans('post::category.cancel') }}</a>
                <button type="submit" class="btn btn-primary btn-sm">{{ trans('post::category.edit_button') }}</button>
            </div>
        </form>
    </div>
</div>