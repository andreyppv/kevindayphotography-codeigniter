$(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        numFiles = input.get(0).files ? input.get(0).files.length : 1,
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [numFiles, label]);
});

$('.datepicker-input').datepicker({
    weekStart: 1,
    autoclose: true,
    todayHighlight: true,
    format: 'yyyy-mm-dd',
});

$('.monthpicker-input').datepicker({
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months",
    autoclose: true,
});

$('.btn-delete').on("click", function() {
    link = $(this).data('href');
    
    swal({
        title: "Are you sure?",
        text: "You will not be able to restore this!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes',
        cancelButtonText: "No!",
        closeOnConfirm: false,
        //closeOnCancel: false
    },
    function(isConfirm) {
        if (isConfirm) {
            document.location.href = link;
        }
    });
    
});

$('th.sort_th').click(function() {
    if(link = $(this).data('href'))
    {
        document.location.href = link;
    }
});