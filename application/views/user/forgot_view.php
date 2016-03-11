<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="container">
    <div class="row">
        <h1>Did you forget your password?</h1>
        <div class="col-lg-4 col-lg-offset-4">
            <?php echo $_SESSION['auth_message'];?>
            <?php echo form_open('',array('class'=>'form-horizontal'));?>
            <div class="form-group">
                <?php echo form_label('Username','username');?>
                <?php echo form_error('username');?>
                <?php echo form_input('username','','class="form-control"');?>
            </div>
            <div class="form-group">
                <?php echo form_submit('submit', 'Won\'t happen again...', 'class="btn btn-primary btn-lg btn-block"');?>
            </div>
            <?php echo form_close();?>
        </div>
    </div>
</div>
