<?php 
$this->load->model('potfolio_photo_model');
$pm = $this->potfolio_photo_model;
$return_url = urlencode(current_url());
?>

<div class="row">
    <div class="col-lg-12">        
        <div class="pull-right" style="margin-top:-70px;">
            <a class="btn btn-primary" href="<?php echo admin_url('potfolio/create?return_url='.$return_url); ?>">Create Potfolio</a>
        </div>
        
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover dataTable" id="data-table">
            <colgroup>
                <col width="90"/>
                <col width="100"/>
                <col width=""/>
                <col width="150"/>
                <col width="200"/>
                <col width="50"/>
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Thumbnail</th>
                    <?php echo th_sort_column($base_uri, 'Name', 'name'); ?>
                    <th>Photos</th>
                    <?php echo th_sort_column($base_uri, 'Created', 'created_at'); ?>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                foreach($rows as $r) 
                { 
                    $i++; 
                    $photos = $pm->where('potfolio_id', $r->id)->count_all();
                ?>
                <tr>
                    <td class="text-right text-middle"><?php echo $i; ?></td>
                    <td><img src="<?php echo thumbnail($this->potfolio_photo_model->main_image($r->id), 100, 100); ?>"/></td>
                    <td class="text-middle"><a href="<?php echo admin_url("potfolio/edit/$r->id?return_url=$return_url"); ?>"><?php echo $r->name; ?></a></td>
                    <td class="text-right"><?php echo $photos; ?></td>
                    <td class="text-center"><?php echo $r->created_at; ?></td>
                    <td class="text-center"><button class="btn btn-danger btn-delete" data-href="<?php echo admin_url("potfolio/delete/$r->id"); ?>" title="Remove"><i class="glyphicon glyphicon-remove"></i></button></td>
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

