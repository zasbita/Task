<?php
include_once 'inc/inc.config.php';
include_once 'inc/inc.header.php';

if ($user->is_loggedin() != "") {
    $user->redirect('task_index.php');
}

if (isset($_POST['btn-login'])) {
    $femail = $_POST['femail'];
    $upass = $_POST['fpwd'];
    if ($user->login($femail, $upass)) {
        $user->redirect('task_index.php');
    } else {
        $error = 'false';
    }
}
?>
<div class="row mzm">   
    <div class="col-md-offset-3 col-md-6">
        <?php
        if (isset($error)) {
            echo '<div class="alert alert-danger">Wrong Email/Password. Please try agian.<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></div>';
        }
        ?>
        <h3 class="text-login"><?php echo 'Login' ?></h3>
        <form method='post' class="form-horizontal">

            <div class="form-group form-group-lg">
                <label for="inputEmail" class="col-sm-3 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control"  name="femail" placeholder="Email" required>
                </div>
            </div>
            <div class="form-group form-group-lg">
                <label for="inputPhone" class="col-sm-3 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" name="fpwd" placeholder="password" required>
                </div>
            </div>    
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-8">
                    <button type="submit" class="btn btn-success btn-lg btn-block" name="btn-login">
                        <span class="glyphicon glyphicon-log-in"></span> Login
                    </button>
                </div>                
            </div>
        </form>
    </div>
</div>
