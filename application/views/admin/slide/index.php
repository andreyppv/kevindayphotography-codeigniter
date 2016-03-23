<?php 
$return_url = urlencode(current_url());
?>

<div class="row">
    <div class="col-lg-12">        
        <div class="pull-right" style="margin-top:-70px;">
            <a class="btn btn-primary" href="<?php echo admin_url('slide/create?return_url='.$return_url); ?>">Create Slide</a>
        </div>
        
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable" id="data-table">
            <colgroup>
                <col width="90"/>
                <col width="100"/>
                <col width=""/>
                <col width="100"/>
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Thumbnail</th>
                    <?php echo th_sort_column($base_uri, 'Name', 'name'); ?>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                <?php foreach($rows as $r) { $i++; ?>
                <tr>
                    <td class="text-right text-middle"><?php echo $i; ?></td>
                    <td class="text-center text-middle"><img src="<?php echo thumbnail($r->photo, 50, 50); ?>" style="width:50px;"/></td>
                    <td class="text-middle"><?php echo $r->name; ?></td>
                    <td class="text-center text-middle">
                        <a class="btn btn-info btn-sm" title="Edit" href="<?php echo admin_url("slide/edit/$r->id"); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                        <button class="btn btn-danger btn-sm btn-delete" title="Remove" data-href="<?php echo admin_url("slide/delete/$r->id"); ?>"><i class="glyphicon glyphicon-remove"></i></button>
                    </td>
                </tr> 
                <?php } ?>
                
                <?php if(empty($rows)) { ?>
                <tr>
                    <td colspan="10">There is no slides.</td>
                </tr>
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
    <div class="col-sm-6">
        <div class="dataTables_info" id="data-table_info" role="status" aria-live="polite"></div>
    </div>
    <div class="col-sm-6">
        <?php echo $this->pagination->create_links(); ?>
    </div>
</div>