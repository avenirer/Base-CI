<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
</div>
<footer>
    <div class="container">
        <p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
    </div>
</footer>
<script src="<?php echo site_url('assets/js/bootstrap.min.js');?>"></script>
<?php echo $before_closing_body;?>
<script>
$('.login-form').on('submit', function(e)
{
    var username = $('#username').val();
    var password = $('#password').val();
    if(username.length==0 || password.length==0)
    {
        $(".login-message").html("You need to have a username and a password to login");
    }
    else
    {
        $.ajax({
            url: "<?php echo site_url('user/login');?>",
            type: 'post',
            data: {ajax: 1, username: username, password: password},
            cache: false,
            success: function (json) {
                var error_message = json.error;
                var success = json.logged_in;
                if (typeof error_message !== "undefined") {
                    $(".login-message").html(error_message);
                }
                else if (typeof success !== "undefined" && success == "1") {
                    $(".login-message").html("You've been successfully logged in!");
                    $(".login-form").hide();
                }
                else {
                    $(".username_error").html(json.username_error);
                    $(".password_error").html(json.password_error);
                }
            }
        });
    }
    e.preventDefault();
});
</script>
</body>
</html>