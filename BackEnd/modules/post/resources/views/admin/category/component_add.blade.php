<div class="card">
    <div class="card-header header-elements-inline">
        <h5 class="card-title">{{ trans('post::category.add_cat') }}</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('category.admin.add') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group">
                <label><strong>{{ trans('post::category.parent_cat') }}</strong></label>
                <select name="parent_id" class="form-control">
                    <option value="0">-- {{ trans('post::category.parent') }} --</option>
                    @if (isset($listCategory) && count($listCategory))
                    @foreach ($listCategory as $cat)
                    <option value="{{ $cat['id'] }}" {{ old('parent_id') == $cat['id'] ? 'selected' : '' }}>
                        {{ $cat['prefix'] }} {{ $cat['title'] }}
                    </option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.title') }}</strong> <sup class="text-danger">(∗)</sup></label>
                <input name="title" id="txtTitle" type="text" class="form-control"
                    placeholder="{{ trans('post::category.title') }}" value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.slug') }}</strong> <sup class="text-danger">(∗)</sup></label>
                <div class="input-group">
                    <input placeholder="{{ trans('post::category.slug') }}" id="txtSlug" type="text"
                        class="form-control" name="slug" value="{{ old('slug') }}">
                    <div class="input-group-prepend mr-0">
                        <a href="javascript:;" onclick="get_slug('#txtTitle', '#txtSlug');"
                            class="btn btn-dark btn-sm"><em class="fa fa-sync"></em></a>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.image') }}</strong></label>
                <div class="input-group areaBrowserFile">
                    <input placeholder="{{ trans('post::category.image') }}" readonly type="text" id="cat-image"
                        class="form-control" name="image" value="{{ old('image') }}">
                    <div class="input-group-prepend mr-0">
                        <button class="btn btn-light btn-sm btn-remove-file text-danger" type="button"><i
                                class="fa fa-times"></i></button>
                        <button class="btn btn-dark btn-sm btn-choose-file" data-id="cat-image" type="button"><i
                                class="fa fa-image mr-1"></i>{{ trans('post::category.image') }}</button>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label><strong>{{ trans('post::category.description') }}</strong></label>
                <textarea name="description" class="form-control"
                    placeholder="{{ trans('post::category.description') }}" rows="3">{{ old('description') }}</textarea>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-3"><strong>{{ trans('post::category.status')  }}</strong></label>
                <div class="col-lg-9">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <div class="uniform-choice">
                                <div class="uniform-choice">
                                    <input name="status" type="radio" class="form-check-input-styled"
                                        {{ old('status', 1) == 1 ? 'checked' : '' }} value="1">
                                </div>
                            </div>
                            <span class="text-success">{{ trans('post::category.active') }}</span>
                        </label>
                    </div>
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <div class="uniform-choice">
                                <div class="uniform-choice">
                                    <input name="status" type="radio" class="form-check-input-styled"
                                        {{ old('status', 1) == 0 ? 'checked' : '' }} value="0">
                                </div>
                            </div>
                            <span class="text-danger">{{ trans('post::category.deactive') }}</span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="float-right">
                <button type="submit" class="btn btn-primary btn-sm">{{ trans('post::category.save') }}</button>
            </div>
        </form>
    </div>
</div>