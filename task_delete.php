<?php
include_once 'inc/inc.config.php';
include_once 'inc/inc.header.php';

if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>

<div class="row mzm">

    <?php
    if (isset($_GET['delete_id']) && is_numeric($_GET['delete_id'])) {
        $id = $_GET['delete_id'];
        $crud->delete($id);
        if ($crud->delete($id)) {
            header("Location: delete.php?deleted");
        } else {
            header("Location: delete.php?failure");
        }
    }
    if (isset($_GET['deleted']) && $_GET['deleted'] = "deleted") {
        echo '<div class="alert alert-info">The user has been deleted. <a href="index.php"><strong>HOME</strong></a>!</div>';
    } else if (isset($_GET['failure']) && $_GET['failure'] = "failure") {
        echo '<div class="alert alert-warning">The user could not be delete. Please, try again. <a href="index.php"><strong>HOME</strong></a>!</div>';
    } else {
        echo '<div class="alert alert-danger">Invalid Input. <a href="index.php"><strong>HOME</strong></a>!</div>';
    }
    ?>

</div>
