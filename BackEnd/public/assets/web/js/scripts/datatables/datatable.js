/*=========================================================================================
    File Name: datatables-basic.js
    Description: Basic Datatable
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(document).ready(function () {
    /****************************************
     *       js of zero configuration        *
     ****************************************/

    if (!$().DataTable) {
        console.warn("Warning - datatables.min.js is not loaded.");
        return;
    }

    // Setting datatable defaults
    $.extend($.fn.dataTable.defaults, {
        autoWidth: false,

        language: {
            sInfo: "Hiển thị _START_ đến _END_ của _TOTAL_ bản ghi",
            search: "<label style>Tìm kiếm:</label> _INPUT_",
            searchPlaceholder: "Nhập tìm kiếm...",
            lengthMenu: "<spanlabel>Hiển thị:</spanlabel> _MENU_",
            paginate: {
                first: "First",
                last: "Last",
                next: $("html").attr("dir") == "rtl" ? "&larr;" : "&rarr;",
                previous: $("html").attr("dir") == "rtl" ? "&rarr;" : "&larr;",
            },
        },
    });

    $(".zero-configuration").DataTable({
        ordering: false,
    });
});
