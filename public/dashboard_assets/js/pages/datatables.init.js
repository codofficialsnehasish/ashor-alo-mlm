// $(document).ready(function() {
//     $("#datatable").DataTable(), $("#datatable-buttons").DataTable({
//         lengthChange: !1,
//         buttons: ["copy", "excel", "pdf", "colvis"]
//     }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"), $(".dataTables_length select").addClass("form-select form-select-sm")
// });

$(document).ready(function() {
    $("#datatable").DataTable();

    // Initialize DataTable for #datatable-buttons (single table by ID)
    $("#datatable-buttons").DataTable({
        lengthChange: false,
        buttons: ["copy", "excel", "pdf", "colvis"]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    // Initialize DataTables for all elements with .datatable-buttons (class)
    // $(".datatable-buttons").DataTable({
    //     lengthChange: false,
    //     buttons: ["copy", "excel", "pdf", "colvis"]
    // }).buttons().container().appendTo(".datatable-buttons_wrapper .col-md-6:eq(0)");


    $(".datatable-buttons").each(function () {
        var table = $(this).DataTable({
            lengthChange: false,
            buttons: ["copy", "excel", "pdf", "colvis"]
        });

        table.buttons()
            .container()
            .appendTo($(this).closest(".dataTables_wrapper").find(".col-md-6:eq(0)"));
    });


    
    $("#datatable-buttons-desc").DataTable({
        lengthChange: !1,
        order: [[0, 'desc']],
        buttons: ["copy", "excel", "pdf", "colvis"]
    }).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $("#datatable-buttons-sell-report").DataTable({
        lengthChange: false,
        buttons: ["copy", "excel", "pdf", "colvis"],
        order: [[6, 'asc']],
    }).buttons().container().appendTo("#datatable-buttons-sell-report_wrapper .col-md-6:eq(0)");
    

    

    // Apply the form styling once
    $(".dataTables_length select").addClass("form-select form-select-sm");
});