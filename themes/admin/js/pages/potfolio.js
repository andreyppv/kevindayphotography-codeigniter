$('#file_upload').uploadify({
    'hideButton'    : true,
    'wmode'         : 'transparent',
    'buttonText'    : 'Select Files',
    'swf'      : base_url + 'assets/js/plugins/uploadify/uploadify.swf',
    'uploader' : base_url + 'fileupload/potfolio',
    'auto'     : false,
    'onUploadSuccess' : function(file, data, response) {
        json = $.parseJSON(data);
        if(json.msg != '') 
		{
			alert(json.msg);
			return;
		}
		
        row = $('#row-template').clone();
        row.removeAttr('id');
        $('.place-holder', row).attr('data-src', json.src);
        $('.thumbnail', row).attr('src', json.path);
        $('.img-sort', row).val(last_sort_number()); 
        
        $('#image-table tbody').append(row);
    }
});

button = '<input type="button" class="btn btn-default" value="Upload Files" id="btn-start-upload"/>';
$(button).insertAfter('#file_upload');
$(document).on('click', '#btn-start-upload', function() {
    $("#file_upload").uploadify('upload', '*');
});  

$('.btn-save').click(function() {
    //for new data
    image_data = new Array();
    
    $('#image-table tbody tr').each(function() {
        item = new Object();
        item.label = $('.img-label', $(this)).val();
        item.main = $('.img-main', $(this)).is(':checked') ? '1' : '0';
        item.sort = $('.img-sort', $(this)).val();
        item.remove = $('.img-remove', $(this)).is(':checked') ? '1' : '0';
        if($(this).hasClass('new'))
        {
            item.type = 'new';
            item.src = $('.place-holder', $(this)).data('src');
            item.id = '';
        }
        else
        {
            item.type = 'old';
            item.src = '';
            item.id = $(this).data('index');
        }
        
        image_data.push(item);
    });
    
    json = JSON.stringify(image_data);
    //if(json == '') $(this).stopPropagation();
    $('#image_data').val(json);
    //alert($('#image_data').val());    
});

$(document).on('mouseenter', '.place-holder', function() {
    $(this).hide();
    $('img', $(this).parent()).show();
});

$(document).on('click', '.btn-remove', function() {
    tr = $(this).parents('tr');
    if(tr.hasClass('new')) 
    {
        tr.remove();
    }
    else
    {
        $('.img-remove', tr).prop( "checked", true );
        tr.hide();
    }
});

function last_sort_number()
{
    obj = $('#image-table tbody tr:last .img-sort');
    if(obj.length > 0) return parseInt(obj.val()) + 1;
    
    return 1;
}