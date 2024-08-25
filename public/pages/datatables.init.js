/*
 Template Name: Zoter - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Datatable js
 */
 let table;

$(document).ready(function() {
    $('#datatable').DataTable();

    //Buttons examples
        table = $('.datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        "ordering": false

    });
   
    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        table.buttons().container()
        .appendTo('.datatable-buttons_wrapper .col-md-6:eq(0)');
} );

function initializeDataTable() {
    /* table.destroy();
    table = $('.datatable-buttons').DataTable({
        lengthChange: false,
        buttons: ['copy', 'excel', 'pdf', 'colvis'],
        "ordering": false

    });
   
    table.buttons().container()
        .appendTo('#datatable-buttons_wrapper .col-md-6:eq(0)');
        table.buttons().container()
        .appendTo('.datatable-buttons_wrapper .col-md-6:eq(0)'); */
}
