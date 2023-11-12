<?php
include_once 'inc/inc.config.php';
include_once 'inc/inc.header.php';

if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>

<div class="row mzm">
    <?php
    if (isset($_GET['view_id']) && is_numeric($_GET['view_id'])) {
        $id = $_GET['view_id'];
        extract($crud->read($id));
    }
    ?>
    <h3 class="text-center"><?php echo 'Details Record' ?></h3>
    <div class="col-lg-offset-3 col-md-6">
        <table class='table table-bordered'>
            <tr>
                <th>Name</th>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Phone</th>
                <td><?php echo $phone; ?></td>
            </tr>
            <tr>
                <th>Action</th>
                <td>
                    <a class="btn btn-info btn-sm" href="user_edit.php?edit_id=<?php print($id); ?>">Edit</a>                               
                    <a class="btn btn-danger btn-sm" href="user_delete.php?delete_id=<?php print($id); ?>" onClick="return confirm('are you sure you want to delete?');">Delete</a>                        
                </td>
            </tr>
        </table>
    </div>
</div>
