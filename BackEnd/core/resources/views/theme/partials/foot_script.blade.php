<script src="{{ asset('assets/admin/js/main/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/loaders/blockui.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/ui/ripple.min.js') }}"></script>
<!-- /core JS files -->

<script src="{{ asset('assets/admin/js/plugins/ui/perfect_scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/ui/headroom.min.js') }}"></script>
<script src="{{ asset('assets/js.cookie.min.js') }}"></script>

<script src="{{ asset('assets/admin/js/plugins/notifications/sweet_alert.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/forms/styling/uniform.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/ui/dragula.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/forms/styling/switchery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/plugins/forms/styling/switch.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script src="{{ asset('assets/admin/js/noty.min.js') }}"></script>
@if (request()->route()->action['as'] != 'login')
<script src="{{ asset('assets/admin/js/notification.js') }}"></script>
@endif
<script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('assets/admin/js/dev.custom.js') }}"></script>
<!-- /theme JS files -->
<script>
    (function ($, DataTable) {

        // Datatable global configuration
        $.extend(true, DataTable.defaults, {
            language: {
                "emptyTable": "Không có dữ liệu",
                "sProcessing":   "Đang xử lý...",
                "sLengthMenu":   "Hiển thị  _MENU_ mục",
                "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
                "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
                "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
                "sInfoFiltered": "(được lọc từ _MAX_ mục)",
                "sInfoPostFix":  "",
                "sSearch":       "Tìm:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Đầu",
                    "sPrevious": "Trước",
                    "sNext":     "Tiếp",
                    "sLast":     "Cuối"
                }
            }
        });

    })(jQuery, jQuery.fn.dataTable);
</script>
<script>
    $(document).ready(function(){
        $('.form-check-input-styled').uniform();

        var navbarTop = document.querySelector('.navbar-slide-top');
        if (navbarTop) {
            // Construct an instance of Headroom, passing the element
            var headroomTop = new Headroom(navbarTop, {
                offset: navbarTop.offsetHeight,
                tolerance: {
                    up: 10,
                    down: 10
                },
                onUnpin: function () {
                    $('.headroom').find('.show').removeClass('show');
                    $('.sidebar-fixed .sidebar-content').css('top', '0px');
                },
                onPin: function () {
                    $('.sidebar-fixed .sidebar-content').css('top', '3.00003rem');
                }
            });
            headroomTop.init();
        }

        var ps = new PerfectScrollbar(".sidebar-fixed .sidebar-content", {
            wheelSpeed: 2,
            wheelPropagation: true
        });

        var elems = Array.prototype.slice.call(document.querySelectorAll('.form-check-input-switchery'));
        elems.forEach(function(html) {
            var switchery = new Switchery(html,{
                secondaryColor: '#d8201c'
            });
        });

        @if (isset($errors) && count($errors->all()) > 0)
            @foreach ($errors->all() as $message)
                app.showNotify("{{ $message }}", "error");
            @endforeach
        @endif

        @if(session('flash_data'))
            @php
                $flash_data = session('flash_data');
            @endphp
            app.showNotify("{{ $flash_data['message'] }}", "{{ $flash_data['type'] }}");
        @endif
    });
</script>
