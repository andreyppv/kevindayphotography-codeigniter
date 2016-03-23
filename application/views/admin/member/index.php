<div class="row">
    <div class="col-lg-12">        
        <div class="pull-right" style="margin-top:-70px;">
            <a class="btn btn-primary" href="<?php echo admin_url('member/create'); ?>">Create Member</a>
        </div>
        
        <div class="dataTable_wrapper">
            <table class="table table-striped table-bordered table-hover" id="data-table">
            <colgroup>
                <col width="90"/>
                <col width="100"/>
                <col width="120"/>
                <col width=""/>
                <col width="160"/>
                <col width="50"/>
            </colgroup>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Avatar</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                <?php foreach($rows as $r) { $i++; ?>
                <tr>
                    <td class="text-right text-middle"><?php echo $i; ?></td>
                    <td class="text-center"><img src="<?php echo thumbnail($r->avatar, 50, 50, 'no'); ?>" style="width:50px;"/></td>
                    <td class="text-middle"><a href="<?php echo admin_url("member/edit/$r->id"); ?>"><?php echo $r->name; ?></a></td>
                    <td class="text-middle"><?php echo $r->email; ?></td>
                    <td class="text-center text-middle"><?php echo date('Y-m-d H:i', strtotime($r->created_at)); ?></td>
                    <td class="text-center"><button class="btn btn-warning btn-delete" data-href="<?php echo admin_url("member/delete/$r->id"); ?>">Remove</button></td>
                </tr> 
                <?php } ?>
            </tbody>
            </table>
        </div>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->