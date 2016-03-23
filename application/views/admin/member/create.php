<div class="row">
    <div class="col-lg-12">
        
        <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal', 'id' => 'aform', 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo form_error('user-name') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="user-name" name="user-name" placeholder="Name" value="<?php echo set_value('user-name'); ?>">
                    <span class="help-inline"><?php echo form_error('user-name');?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo form_error('user-email') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="user-email" name="user-email" placeholder="Email" value="<?php echo set_value('user-email'); ?>">
                    <span class="help-inline"><?php echo form_error('user-email');?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo isset($user_avatar_message) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Avatar</label>
                <div class="col-sm-8">
                    <div class="user-avatar-img-box" style="margin-bottom:5px;">
                        <img src="<?php echo thumbnail('', 112, 112); ?>" id="user-avatar-img"/>
                    </div>
                    
                    <span class="btn btn-default btn-file">
                        Browse <input type="file" id="user-avatar" name="user-avatar">
                    </span>
                    <span class="help-inline"><?php echo isset($user_avatar_message) ? $user_avatar_message : '';?></span>
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <a class="btn btn-default" href="<?php echo admin_url('member'); ?>">Back</a>
                    <button class="btn btn-primary" type="submit" name="btn-save" value="1">Save</button>
                </div>    
            </div>
        <?php echo form_close(); ?>
                
    </div>
</div>