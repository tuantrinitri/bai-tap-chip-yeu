<div class="navbar navbar-expand-lg navbar-light">
    <div class="navbar-collapse collapse" id="navbar-footer">
        <span class="navbar-text">
            <strong>{{ trans('core::common.powered_by') }}</strong> <a href="https://www.facebook.com/quoctuan.282/" target="_blank"><strong>NTD Group</strong></a>. {{ trans('core::common.version') }} <span class="badge badge-warning">{{ config('cms.version') }}</span>
        </span>

        <div class="navbar-nav ml-lg-auto">
            <small><strong>{{ trans('core::common.memory') }}:</strong> {{ cms_format_bytes(memory_get_usage()) }}, <strong>{{ trans('core::common.executed_time') }}:</strong> {{ number_format((microtime(true) - LARAVEL_START), 3, '.', '')   }} {{ trans('core::common.seconds') }}</small>
        </div>
    </div>
</div>

<div id="modalSelectFile" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-full">
        <div class="modal-content" style="height:90vh">
            <div class="modal-header">
                <h5 class="modal-title">Chọn tệp tin</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" style="padding:0 2px 10px;">
                <div class="row mb-5 mt-5">
                    <div class="col-12">
                        <div class="text-center text-muted" style="opacity: 0.75;">
                            <i class="fa fa-file-image fa-4x mb-1"></i>
                            <p><em>Đang tải trình quản lý file</em></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>