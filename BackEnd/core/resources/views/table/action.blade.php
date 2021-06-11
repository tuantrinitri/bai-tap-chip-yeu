@if (Arr::has($actions, 'edit'))
<a href="{{ $actions['edit']['link'] }}" class="text-warning mr-2" data-popup="tooltip" title="{{ trans('core::button.edit') }}"><i class="fa fa-edit"></i></a>
@endif
@if (Arr::has($actions, 'delete'))
<a href="javascript:;" onclick="action_delete(this);return false;" data-table="{{ $table_id ?? '' }}" data-href="{{ $actions['delete']['link'] }}" class="text-danger" data-popup="tooltip" title="{{ trans('core::button.delete') }}"><i class="fas fa-trash-alt"></i></a>
@endif
