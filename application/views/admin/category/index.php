<div class="row">
    <div class="col-lg-12">        
        <div class="pull-right" style="margin-top:-70px;">
            <a class="btn btn-primary" href="<?php echo admin_url('category/create'); ?>">Create</a>
        </div>
        
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="data-table">
            <colgroup>
                <col width="90"/>
                <col width=""/>
                <col width="60"/>
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                <?php foreach($rows as $r) { $i++; ?>
                <tr>
                    <td class="text-right text-middle"><?php echo $i; ?></td>
                    <td class="text-middle"><a href="<?php echo admin_url("category/edit/$r->cat_id"); ?>"><?php echo $r->cat_name; ?></a></td>
                    <td class="text-center"><button class="btn btn-danger btn-delete" data-href="<?php echo admin_url("category/delete/$r->cat_id"); ?>" title="Remove"><i class="glyphicon glyphicon-remove"></i></button></td>
                </tr> 
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->