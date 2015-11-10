<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="row">
        <?php
        echo isset($_SESSION['auth_message']) ? $_SESSION['auth_message'] : FALSE;
        ?>
        <h1>Login</h1>
        <div class="col-lg-4 col-lg-offset-4">
            <?php echo $this->session->flashdata('message');?>
            <?php echo form_open('',array('class'=>'form-horizontal'));?>
            <div class="form-group">
                <?php echo form_label('Username','username');?>
                <?php echo form_error('username');?>
                <?php echo form_input('username','','class="form-control"');?>
            </div>
            <div class="form-group">
                <?php echo form_label('Password','password');?>
                <?php echo form_error('password');?>
                <?php echo form_password('password','','class="form-control"');?>
            </div>
            <div class="form-group">
                <label>
                    <?php echo form_checkbox('remember','1',FALSE);?> Remember me
                </label>
            </div>
            <?php echo form_submit('submit', 'Log in', 'class="btn btn-primary btn-lg btn-block"');?>
            <?php echo form_close();?>
        </div>
    </div>
</div>
