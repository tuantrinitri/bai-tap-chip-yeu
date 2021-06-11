@extends('core::theme.layouts.default')
@section('page_content')
    <div class="card-body">
        <form action="{{ route('banner.admin.create') }}" method="post">
            {{ csrf_field() }}
            <table class="table">
                <colgroup>
                    <col class="w200">
                    <col>
                </colgroup>
                <tbody>
                    <tr>
                        <td style="width:200px"><strong>Tiêu đề</strong> <sup class="text-danger">(*)</sup></td>
                        <td>
                            <input type="text" class="form-control w300" name="title" value="{{ old('title') }}">
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Chọn file ảnh</strong> <sup class="text-danger"></sup></td>
                        <td>
                            <div class="input-group areaBrowserFile">
                                <input placeholder="Chưa chọn hình ảnh" readonly type="text" id="file_src-image"
                                    class="form-control" name="file_src" value="{{ old('file_src') }}">
                                <div class="input-group-prepend mr-0">
                                    <button class="btn btn-light btn-sm btn-remove-file text-danger" type="button"><i
                                            class="fa fa-times"></i></button>
                                    <button class="btn btn-dark btn-sm btn-choose-file" data-id="file_src-image"
                                        type="button"><i class="fa fa-image mr-1"></i> Chọn ảnh</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Liên kết</strong></td>
                        <td>
                            <input type="text" class="form-control w300" name="link" value="{{ old('link') }}">
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Thời hạn</strong></td>
                        <td class="datepicker-wrap">
                            <input placeholder="Chọn khoảng thời gian" autocomplete="off" name="available_time" type="text"
                                class="form-control daterange-basic" value="{{ old('available_time') }}">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="row" style="padding: 50px">
                <div class="col-sm-12 text-center">
                    <button type="submit" class="btn btn-info">Thêm banner</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('custom_js')
    <script src="{{ asset('assets/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pickers/daterangepicker.js') }}"></script>
    <script>
        $('.daterange-basic').daterangepicker({
            autoUpdateInput: false,
            timePicker: true,
            locale: {
                format: 'DD/MM/YYYY',
                cancelLabel: 'Clear'
            }
        });
        $('.daterange-basic').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
        });

        $('.daterange-basic').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    </script>
@endsection
