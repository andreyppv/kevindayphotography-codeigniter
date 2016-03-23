$(document).ready(function() {
    $('#data-table').DataTable({
        columnDefs: [ { orderable: false, targets: [ <?php echo join(',', $inds); ?> ] } ],
        responsive: true
    });
});