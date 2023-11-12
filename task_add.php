<?php
include_once 'inc/inc.config.php';
include_once 'inc/inc.header.php';
use MyConfig\Config;

$config = new Config();
$user = $config->user;
$crud = $config->crud;
$session = $_COOKIE['user'];

if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}

?>

<div class="row mzm">
    <?php
    if (isset($_POST['btn-save'])) {
        $name = $_POST['name'];
        $image = $_FILES['image'];
        $date = date('Y-m-d');
        $token = $_POST['token'];
        $crud->create($name, $image, $date, $token);
    }

    if (isset($_GET['inserted']) && $_GET['inserted'] = "inserted") {
        echo '<div class="alert alert-info">The user has been saved. <a href="index.php"><strong>HOME</strong></a>!</div>';
    } else if (isset($_GET['failure']) && $_GET['failure'] = "failure") {
        echo '<div class="alert alert-warning">The user could not be saved. Please, try again.  <a href="index.php"><strong>HOME</strong></a>!</div>';
    } 
    ?>
    <h3 class="text-center"><?php echo 'New Record' ?></h3>
    <form method='post' class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="token" value="<?php echo $session?>">
        <div class="form-group form-group-lg">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="name" placeholder="Full Name" required> 
            </div>
        </div>
        <div class="form-group form-group-lg">
            <label for="inputPhone" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-8">
                <input type="file" class="form-control" name="image" required accept="image/*">
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
