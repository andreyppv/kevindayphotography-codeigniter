<?php
    $username = $this->input->post('username') ? $this->input->post('username') : '';
    $password = $this->input->post('password') ? $this->input->post('password') : '';
?>

<div class="panel-heading">
    <h3 class="panel-title">Please Sign In</h3>
</div>
<div class="panel-body">
    <?php echo form_open($this->uri->uri_string()); ?>
    <fieldset>
        <div class="form-group">
            <input type="text" class="form-control" placeholder="E-mail" name="username" id="username" value="<?php echo $username; ?>" required autofocus>
        </div>
        <div class="form-group">
            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="<?php echo $password; ?>" required value="">
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="1" name="remember_me" id="remember_me" <?php echo $this->input->post('remember_me') ? "checked='checked'" : ''; ?>>Remember Me
            </label>
        </div>
        <!-- Change this to a button or input when using this as a form -->
        <button type="submit" class="btn btn-lg btn-success btn-block" name="btn-login" value="1">Login</button>
    </fieldset>
    <?php echo form_close(); ?>
</div>