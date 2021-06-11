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
