<div class="row">
    <div class="col-lg-12">
        
        <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal', 'id' => 'aform', 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo isset($user_avatar_message) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Avatar</label>
                <div class="col-sm-8">
                    <div class="user-avatar-img-box" style="margin-bottom:5px;">
                        <img src="<?php echo thumbnail($row->avatar, 112, 112); ?>" id="user-avatar-img"/>
                    </div>
                    
                    <span class="btn btn-default btn-file">
                        Browse <input type="file" id="user-avatar" name="user-avatar">
                    </span>
                    <span class="help-inline"><?php echo isset($user_avatar_message) ? $user_avatar_message : '';?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo form_error('user-name') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="user-name" name="user-name" placeholder="Name" value="<?php echo set_value('user-name', $row->name); ?>">
                    <span class="help-inline"><?php echo form_error('user-name');?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo form_error('user-email') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Email</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="user-email" name="user-email" placeholder="Email" value="<?php echo set_value('user-email', $row->email); ?>">
                    <span class="help-inline"><?php echo form_error('user-email');?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo form_error('user-password') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Password" value="">
                    <span class="help-inline"><?php echo form_error('user-password');?></span>
                </div>
            </div>
            
            <br/><hr/>
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <label style="display:block;"><input type="checkbox" placeholder="check-new-password" class="form-control" name="check-new-password" id="check-new-password" value="1" <?php echo $this->input->post('check-new-password')?"checked='checked'":''; ?> style="display:inline;height:auto;margin-right:7px; width:auto;">New Password</label>
                </div>
            </div>
            
            <div class="form-group <?php echo form_error('new-password') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">New Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="new-password" name="new-password" placeholder="New Password" value="<?php echo set_value('new-password'); ?>">
                    <span class="help-inline"><?php echo form_error('new-password');?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo form_error('new-password-confirm') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Password Confirmation</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="new-password-confirm" name="new-password-confirm" placeholder="Password Confirmation" value="<?php echo set_value('new-password-confirm'); ?>">
                    <span class="help-inline"><?php echo form_error('new-password-confirm');?></span>
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