<div class="row">
    
    <!--General Setting-->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">General</div>
            <div class="panel-body">
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'id' => 'aform', 'autocomplete' => 'off')); ?>
                    
                <div class="form-group <?php echo form_error('title') ? 'has-error' : ''; ?>">
                    <label class="control-label col-sm-2">Sitte Title</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Site Title" value="<?php echo set_value('title', $settings['site.title']); ?>">
                        <span class="help-inline"><?php echo form_error('title');?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2">Sitte Status</label>
                    <div class="col-sm-8">
                        <select name="status" id="status" class="form-control" style="width:auto;">
                            <option value="1" <?php echo isset($settings) && $settings['site.status'] == 1 ? 'selected="selected"' : set_select('site.status', '1') ?>>Online</option>
                            <option value="0" <?php echo isset($settings) && $settings['site.status'] == 0 ? 'selected="selected"' : set_select('site.status', '1') ?>>Offline</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit" name="btn-save-general" value="1">Save</button>
                    </div>    
                </div>
                    
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!--End General Setting-->
    
    <!--General Setting-->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Email</div>
            <div class="panel-body">
                <?php echo form_open($this->uri->uri_string(), array('class' => 'form-horizontal', 'id' => 'aform-email', 'autocomplete' => 'off')); ?>
                    
                <div class="form-group <?php echo form_error('sender_email') ? 'has-error' : ''; ?>">
                    <label class="control-label col-sm-2">System Email</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="sender_email" name="sender_email" placeholder="Site Title" value="<?php echo set_value('sender_email', $settings['site.system_email']); ?>">
                        <span class="help-inline"><?php echo form_error('sender_email');?></span>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2">Email Type</label>
                    <div class="col-sm-8">
                        <select name="mailtype" id="mailtype" class="form-control" style="width:auto;">
                            <option value="text" <?php echo $settings['mailtype'] == 'text' ? 'selected="selected"' : ''; ?>>Text</option>
                            <option value="html" <?php echo $settings['mailtype'] == 'html' ? 'selected="selected"' : ''; ?>>HTML</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group <?php echo form_error('protocol') ? 'error' : ''; ?>">
                    <label class="control-label col-sm-2">Email Server</label>
                    <div class="col-sm-8">
                        <select name="protocol" id="server_type" class="form-control" style="width:auto;">
                            <option <?php echo set_select('protocol', 'mail', $settings['protocol'] == 'mail' ? TRUE : FALSE); ?>>mail</option>
                            <option <?php echo set_select('protocol', 'sendmail', $settings['protocol'] == 'sendmail' ? TRUE : FALSE); ?>>sendmail</option>
                            <option value="smtp" <?php echo set_select('protocol', 'smtp', $settings['protocol'] == 'smtp' ? TRUE : FALSE); ?>>SMTP</option>
                        </select>
                        <span class="help-inline"><?php echo form_error('protocol'); ?></span>
                    </div>
                </div>
                
                <div>
                    <!-- PHP Mail -->
                    <div id="mail" class="form-group">
                        <div class="col-sm-8 col-sm-offset-2"><b>Mail</b> uses the standard PHP mail function, so no settings are necessary.</div>
                    </div>
                    
                    <!-- Sendmail -->
                    <div id="sendmail" class="form-group <?php echo form_error('mailpath') ? 'error' : ''; ?>" style="padding-top: 27px">
                        <label class="control-label col-sm-2" for="mailpath">Sendmail location</label>
                        <div class="col-sm-8">
                            <input type="text" name="mailpath" id="mailpath" class="form-control" value="<?php echo set_value('mailpath', $settings['mailpath']) ?>" />
                            <span class="help-inline"><?php echo form_error('mailpath'); ?></span>
                        </div>
                    </div>
                    
                    <!-- SMTP -->
                    <div id="smtp" style="padding-top: 27px">

                        <div class="form-group <?php echo form_error('smtp_host') ? 'error' : ''; ?>">
                            <label class="control-label col-sm-2" for="smtp_host">SMTP Server Address</label>
                            <div class="col-sm-8">
                                <input type="text" name="smtp_host" id="smtp_host" class="form-control" value="<?php echo set_value('smtp_host', $settings['smtp_host']) ?>" />
                                <span class="help-inline"><?php echo form_error('smtp_host'); ?></span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="smtp_user">SMTP Username</label>
                            <div class="col-sm-8">
                                <input type="text" name="smtp_user" id="smtp_user" class="form-control" value="<?php echo set_value('smtp_user', $settings['smtp_user']) ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="smtp_pass">SMTP Password</label>
                            <div class="col-sm-8">
                                <input type="password" name="smtp_pass" id="smtp_pass" class="form-control" value="<?php echo set_value('smtp_pass', $settings['smtp_pass']) ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="smtp_port">SMTP Port</label>
                            <div class="col-sm-8">
                                <input type="text" name="smtp_port" id="smtp_port" class="form-control" value="<?php echo set_value('smtp_port', $settings['smtp_port']) ?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="smtp_timeout">SMTP Timeout (seconds)</label>
                            <div class="col-sm-8">
                                <input type="text" name="smtp_timeout" id="smtp_timeout" class="form-control" value="<?php echo set_value('smtp_timeout', $settings['smtp_timeout']) ?>" />
                            </div>
                        </div>  
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <button class="btn btn-primary" type="submit" name="btn-save-email" value="1">Save</button>
                    </div>    
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!--End General Setting-->
    
    <!-- Test Settings -->
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Test Your Settings</div>
            <div class="panel-body">
                <?php echo form_open(admin_uri('setting/emailtest'), array('class' => 'form-horizontal', 'id' => 'aform-test-email', 'autocomplete' => 'off')); ?>
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">Enter an email address below to verify that your email settings are working.<br/>Please save the current settings before testing.</div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-2" for="test-email">Email</label>
                    <div class="col-sm-8">
                        <input type="email" name="email" id="test-email" class="form-control" value="<?php echo set_value('test_email', settings_item('site.system_email')) ?>" />
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-sm-8 col-sm-offset-2">
                        <input type="submit" name="submit" class="btn btn-primary" value="Send Test Email" />
                    </div>
                </div>
                
                <div class="form-group"><div class="col-sm-8 col-sm-offset-2">
                    <div id="test-ajax"></div>
                </div></div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <!-- End Test Settings -->
</div>