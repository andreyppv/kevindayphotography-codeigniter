<?php
    $return_url = admin_url('slide');
    if($r = $this->input->get('return_url'))
    {
        $return_url = urldecode($r);
    }
?>

<div class="row">
    <div class="col-lg-12">
        
        <?php echo form_open_multipart($this->uri->uri_string(), array('class' => 'form-horizontal', 'id' => 'aform', 'autocomplete' => 'off')); ?>
            <div class="form-group <?php echo form_error('slide-name') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2"><span class="red">*</span>Name</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="slide-name" name="slide-name" placeholder="Name" value="<?php echo set_value('slide-name', $row->name); ?>" required>
                    <span class="help-inline"><?php echo form_error('slide-name');?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo isset($slide_image_message) ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2">Avatar</label>
                <div class="col-sm-8">
                    <div class="avatar-img-box" style="margin-bottom:5px;">
                        <img src="<?php echo thumbnail($row->photo, 250, 250); ?>" id="slide-avatar-img"/>
                    </div>
                    
                    <span class="btn btn-default btn-file">
                        Browse <input type="file" id="slide-image" name="slide-image">
                    </span>
                    <span class="help-inline"><?php echo isset($slide_image_message) ? $slide_image_message : '';?></span>
                </div>
            </div>
            
            <div class="form-group <?php echo form_error('slide-text') ? 'has-error' : ''; ?>">
                <label class="control-label col-sm-2"><span class="red">*</span>Text</label>
                <div class="col-sm-8">
                    <textarea rows="5" class="form-control" id="slide-text" name="slide-text" placeholder="Text" required><?php echo set_value('slide-text', $row->text); ?></textarea>
                    <span class="help-inline"><?php echo form_error('slide-text');?></span>
                </div>
            </div>
                      
            <div class="form-group">
                <div class="col-sm-8 col-sm-offset-2">
                    <a class="btn btn-default" href="<?php echo $return_url; ?>">Back</a>
                    <button class="btn btn-primary" type="submit" name="btn-save" value="1">Save</button>
                    <button class="btn btn-primary" type="submit" name="btn-save-edit" value="1">Save &amp; Continue</button>
                </div>    
            </div>
        <?php echo form_close(); ?>
                
    </div>
</div>