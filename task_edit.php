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
    if (isset($_POST['btn-update'])) {
        $id = $_GET['edit_id'];
        $name = $_POST['name'];
        $image = $_FILES['image'];
        $token = $_POST['token'];
        $crud->update($id, $name, $image, $token);
    }

    if (isset($_GET['edit_id']) && is_numeric($_GET['edit_id'])) {
        $id = $_GET['edit_id'];
        extract($crud->read($id));
    }
    ?>
    <h3 class="text-center"><?php echo 'Update Record' ?></h3>
    <form method='post' class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" name="token" value="<?php echo $session?>">
        <div class="form-group form-group-lg">
            <label for="inputName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required> 
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
                <button type="submit" class="btn btn-success btn-lg"  name="btn-update">
                    <span class="glyphicon glyphicon-plus"></span> Update this Record
                </button>
            </div>
        </div>
    </form>

</div>
