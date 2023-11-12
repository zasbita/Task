<?php
include_once 'inc/inc.config.php';
include_once 'inc/inc.header.php';

if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>

<div class="row mzm">
    <?php
    if (isset($_POST['btn-save'])) {
        $fname = $_POST['fname'];
        $femail = $_POST['femail'];
        $fphone = $_POST['fphone'];

        if ($crud->create($fname, $femail, $fphone)) {
            header("Location: add.php?inserted");
        } else {
            header("Location: add.php?failure");
        }
    }

    if (isset($_GET['inserted']) && $_GET['inserted'] = "inserted") {
        echo '<div class="alert alert-info">The user has been saved. <a href="index.php"><strong>HOME</strong></a>!</div>';
    } else if (isset($_GET['failure']) && $_GET['failure'] = "failure") {
        echo '<div class="alert alert-warning">The user could not be saved. Please, try again.  <a href="index.php"><strong>HOME</strong></a>!</div>';
    } 
    ?>
    <h3 class="text-center"><?php echo 'New Record' ?></h3>
    <form method='post' class="form-horizontal">
        <div class="form-group form-group-lg">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="fname" placeholder="Full Name" required> 
            </div>
        </div>    
        <div class="form-group form-group-lg">
            <label for="inputEmail" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-8">
                <input type="email" class="form-control"  name="femail" placeholder="Email" required>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label for="inputPassword" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control"  name="fpwd" placeholder="password" required>
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label for="inputPhone" class="col-sm-2 control-label">Phone</label>
            <div class="col-sm-8">
                <input type="tel" class="form-control" name="fphone" placeholder="Phone Number" required>
            </div>
        </div>    
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-success btn-lg" name="btn-save">
                    <span class="glyphicon glyphicon-plus"></span> Create New Record
                </button>
            </div>
        </div>
    </form>

</div>
