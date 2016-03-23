$(document).ready(function() {
    $('#data-table').DataTable({
        columnDefs: [ { orderable: false, targets: [ 1 ] } ],
        responsive: true
    });
});