<div class="row">
    <div class="col-lg-12">
        
        <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal', 'id' => 'aform', 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo form_error('client-name') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2"><span class="red">*</span>Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="client-name" name="client-name" placeholder="Name" value="<?php echo set_value('client-name'); ?>" required>
                    <span class="help-inline"><?php echo form_error('client-name');?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo isset($client_avatar_message) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Avatar</label>
                <div class="col-sm-8">
                    <div class="avatar-img-box" style="margin-bottom:5px;">
                        <img src="<?php echo thumbnail('', 128, 128); ?>" id="client-avatar-img"/>
                    </div>
                    
                    <span class="btn btn-default btn-file">
                        Browse <input type="file" id="client-avatar" name="client-avatar">
                    </span>
                    <span class="help-inline"><?php echo isset($client_avatar_message) ? $client_avatar_message : '';?></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <a class="btn btn-default" href="<?php echo admin_url('client'); ?>">Back</a>
                    <button class="btn btn-primary" type="submit" name="btn-save" value="1">Save</button>
                    <button class="btn btn-primary" type="submit" name="btn-save-edit" value="1">Save &amp; Continue</button>
                </div>    
            </div>
        <?php echo form_close(); ?>
                
    </div>
</div>