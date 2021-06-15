@extends('core::theme.layouts.default')

@section('custom_css')
    <style>
        .quantification {
            max-width: 303px;
        }

        .page-header-dark,
        .page-header-light {
            display: none;
        }

    </style>
@endsection
@section('page_content')
    <div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
        <div class="d-flex">
            <div class="breadcrumb">
                <a href="{{ route('dashboard') }}" class="breadcrumb-item"><i class="icon-home2 mr-2"></i>Bảng
                    điều khiển</a>
                <a href="{{ route('import.admin.index') }}" class="breadcrumb-item">Nhập liệu</a>
                <a href="{{ route('import.admin.product.type.list', $shipment->id) }}" class="breadcrumb-item">DS dạng sản
                    phẩm</a>
                <a href="{{ route('import.admin.batch', $product->id) }}" class="breadcrumb-item">DS lô nguyên
                    liệu</a>
                <a href="{{ route('import.admin.ships', $batch->id) }}" class="breadcrumb-item">DS tàu nguyên
                    liệu</a>
                <a href="{{ route('import.admin.technical', $idTauNguyenLieu) }}" class="breadcrumb-item">DS mẻ
                    lưới</a>
                <span class="breadcrumb-item active">Thêm mới thong tin ky thuat</span>

            </div>
        </div>
    </div>
    <div class="card-header header-elements-inline">
        <h5 class="card-title">Thêm mới mẻ đánh bắt</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('import.admin.technical.create', $idTauNguyenLieu) }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="material_ship_id" placeholder="idTauNguyenLieu" value="{{ $idTauNguyenLieu }}">

            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Ngày hạ lưới</label>
                <div class="col-lg-8">
                    <input type="text" placeholder="Chọn ngày hạ lưới" class="form-control pickadate-birthday"
                        name="event_date" value="{{ old('event_date') }}">
                </div>
            </div>

            <div class="form-group row">
                <label class="col-lg-4 col-form-label">Vị trí lên mẻ lưới<sup class="text-danger">(*)</sup></label>
                <div class="col-lg-8">
                    <select class="form-control" required name="geolocation_id" id="">
                        <option value="" selected>Chọn vị trí</option>
                        @foreach ($location as $key => $item)
                            <option value="{{ $item->id }}">{{ $item->title }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-form-label col-lg-4"><strong>Có chuyển tải không</strong></label>
                <div class="col-lg-8">
                    <div class="form-check form-check-inline">
                        <label class="form-check-label">
                            <div class="form-check form-check-inline">
                                <input id="check" type="checkbox" name="is_trasshipment" value="1">
                            </div>

                        </label>
                    </div>
                </div>
            </div>
            <div id="isTranshipment" hidden="true">
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Ngày chuyển tải <sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control pickadate-birthday" name="date_transshipment"
                            placeholder="nhap ngay chuyen tai" value="{{ old('date_transshipment') }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label">Vị trí chuyển tải<sup class="text-danger">(*)</sup></label>
                    <div class="col-lg-8">
                        <select class="form-control" name="loaction_transshipment_id" id="">
                            <option value="" selected>Chọn vị trí</option>
                            @foreach ($location as $key => $item)
                                <option value="{{ $item->id }}">{{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group row mt-4">
                @foreach ($species as $k => $item)
                    <div class="col-4 mt-4">
                        <div class="quantification">
                            <img src="{{ asset($item['image'] ?? 'no-img.jpg') }}" style="max-height: 100px;
                                                                        max-width: 100px;
                                                                        margin-left: 35%;
                                                                        min-height: 63.81px;
                                                                    " alt="">
                        </div>
                        <div class="mt-2">
                            <input type="hidden" name='information_fishing_up[{{ $k }}][species]'
                                value="{{ $item['id'] }}">
                            <input type="number" id="txtNumber" min="0" placeholder="Nhập sản lượng"
                                class="form-control quantification"
                                name='information_fishing_up[{{ $k }}][quantification]'
                                value="{{ old("information_fishing_up[$k]['quantification']") }}">
                            <span id="errorMsg" style="display:none; color: red">Vui lòng nhập giá trị lớn hơn hoặc bằng
                                0</span>
                        </div>
                    </div>
                @endforeach


            </div>

            <div class="text-center mt-2">
                <!-- neu thang nay co tau nguyen lieu roi thi return ve ds tau nguyen lieu || return ve danh sach lo nguyen lieu-->
                {{-- <a href="{{ route('import.admin.ship', $idLoNguyenLieu) }}" class="btn btn-dark">{{ trans('language::button.cancel') }}</a> --}}

                <button type="submit" class="btn btn-success legitRipple">Thêm</button>
            </div>
        </form>
    </div>

@endsection
@section('custom_js')
    <script src="{{ asset('assets/admin/js/plugins/ui/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pickers/anytime.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ asset('assets/admin/js/plugins/pickers/pickadate/legacy.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.pickadate-birthday').pickadate({
                labelMonthNext: 'Go to the next month',
                labelMonthPrev: 'Go to the previous month',
                labelMonthSelect: 'Pick a month from the dropdown',
                labelYearSelect: 'Pick a year from the dropdown',
                selectMonths: true,
                selectYears: 150,
                format: 'dd/mm/yyyy',
                formatSubmit: 'yyyy-mm-dd'
            });
        });

    </script>

    <script>
        $("#txtNumber").keyup(function() {
            if ($('#txtNumber').val() < -0) {
                $('#errorMsg').show();
            } else {
                $('#errorMsg').hide();
            }
        });
        $('#check').change(function() {
            $("#isTranshipment").prop("hidden", !this.checked);
        })

    </script>
@endsection
