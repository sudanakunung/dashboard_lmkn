/**
 * Created by user01 on 07/07/2017.
 */
$(".table-data").dataTable({
    "iDisplayLength": 10,
    "aLengthMenu": [5,10,20,50,100],
    "sPaginationType": "full_numbers"
});

$(document).ready(function() {
    var table = $('.table-data').dataTable();

    // Add event listeners to the two range filtering inputs
    $('#bulan').keyup( function() { table.draw(); } );
    $('#tahun').keyup( function() { table.draw(); } );
});

$(".data").dataTable({
    "iDisplayLength": 10,
    "aLengthMenu": [5,10,20,50,100],
    "sPaginationType": "full_numbers"
});

$(document).ready(function() {
    var table = $('.data').dataTable();
    // Add event listeners to the two range filtering inputs
} );