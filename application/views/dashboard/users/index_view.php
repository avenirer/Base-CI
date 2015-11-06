<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo site_url('dashboard/users/create');?>" class="btn btn-primary">Create user</a>
            <a href="<?php echo site_url('dashboard/users');?>" class="btn btn-primary">See all users</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12" style="margin-top: 10px;">
            <?php
            if(!empty($users))
            {
                echo '<table class="table table-hover table-bordered table-condensed">';
                echo '<tr><td>ID</td><td>Username</td></td><td>Name</td><td>Email</td><td>Last login</td><td>Operations</td></tr>';
                foreach($users as $user)
                {
                    echo '<tr>';
                    echo '<td>'.$user->id.'</td><td>'.$user->username.'</td><td>'.$user->first_name.' '.$user->last_name.'</td></td><td>'.$user->email.'</td><td>'.date('Y-m-d H:i:s', $user->last_login).'</td><td>';
                    if($this->current_user->id != $user->id) echo anchor('dashboard/users/edit/'.$user->id,'<span class="glyphicon glyphicon-pencil"></span>').' '.anchor('dashboard/users/delete/'.$user->id,'<span class="glyphicon glyphicon-remove"></span>');
                    else echo '&nbsp;';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '</table>';
            }
            ?>
        </div>
    </div>