<div class="row">
    <div class="col-lg-12">
        
        <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal', 'id' => 'aform', 'autocomplete' => 'off')); ?>
            
            <div class="form-group <?php echo form_error('cat-name') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="cat-name" name="cat-name" placeholder="Name" value="<?php echo set_value('cat-name', $row->cat_name); ?>">
                    <span class="help-inline"><?php echo form_error('cat-name');?></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <a class="btn btn-default" href="<?php echo admin_url('category'); ?>">Back</a>
                    <button class="btn btn-primary" type="submit" name="btn-save" value="1">Save</button>
                </div>    
            </div>
        <?php echo form_close(); ?>
                
    </div>
</div>