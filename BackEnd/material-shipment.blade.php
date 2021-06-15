@extends('shipment::qr.layout.qrtheme')
@section('qr_content')
    <div class="page-content">
        <div class="content-wrapper">

            <div class="content">
                <h1 class="text-center mt-2"><strong>Hê thống truy xuất GDST</strong></h1>
                <div class="p-3">

                    <div class="row ml-0 mr-0">
                        <div class="card-body">
                            <div class="form-group row">
                                <label class="col-form-label col-lg-2"><strong>Mã số lô hàng:</strong>
                                </label>
                                <div class="col-lg-4">
                                    <label class="form-group">{{ $shipment->shipment_code }}</label>
                                </div>

                                <label class="col-form-label col-lg-2"><strong>Tổng khối lượng:</strong>
                                </label>
                                <div class="col-lg-4">
                                    <label class="form-group">{{ $shipment->shipment_quantification }}</label>
                                </div>
                            </div>
                            <hr>
                            <div id="table-conten">
                                <table class="table datatable-basic">
                                    <thead>
                                        <tr>
                                            <th class="text-center">STT</th>
                                            <th class="text-center">Dạng sản phẩm</th>
                                            <th class="text-center">Quy cách</th>
                                            <th class="text-center">Chất lượng</th>
                                            <th class="text-center">Khối lượng</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $key => $product)
                                            <tr>
                                                <td class="text-center"><strong>{{ ++$key }}</strong></td>
                                                <td class="text-center">
                                                    <strong>{{ $product->product_form_id != 0 ? $product->productFormType->title : $product->different }}</strong>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    {{ $product->specialize }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $product->quality }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $product->quantification }}
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('shipment.qr.material', $product->id) }}">
                                                        Chi tiết
                                                    </a>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
