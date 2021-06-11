@foreach ($widgets as $widget)
<div class="card item-widget" data-id="{{ $widget['id'] }}">
    <form onsubmit="submitUpdateWidget(this);return false;">
        @csrf
        <input type="hidden" name="id" value="{{ $widget['id'] }}">
        <div class="card-header bg-slate">
            <h6 class="card-title">
                <a data-toggle="collapse" class="text-white collapsed" href="#widget-{{ $widget['id'] }}" aria-expanded="false">
                    {{ $widget['title'] }}
                </a>
            </h6>
        </div>
        <div id="widget-{{ $widget['id'] }}" class="collapse">
            <div class="card-body">
                <div class="form-group">
                    <em>Widget:</em> <strong>{{ config($widget['module'] . '::widget.web.' . $widget['name'] . '.title' ) }}</strong>
                </div>
                <div class="form-group">
                    <label><strong>Tiêu đề</strong></label>
                    <input name="title" type="text" class="form-control" placeholder="Nhập tiêu đề" value="{{ $widget['title'] }}">
                </div>
                <hr>
                <button type="submit" class="btn btn-sm btn-info">Lưu lại</button>
                <button onclick="submitDeleteWidget('{{ $widget['id'] }}');" type="button" class="btn btn-sm btn-link float-right"><span class="text-danger"><i class="fa fa-trash-alt"></i></span></button>
            </div>
        </div>
    </form>
</div>
@endforeach