<?php
include_once 'inc/inc.config.php';
include_once 'inc/inc.header.php';

if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>

<div class="row mzm">    
    <div class="btn-group pull-right" role="group" aria-label="...">
        <a class="btn btn-info" href="user_add.php">Add Data</a>
    </div>
    <table id="index_users" class="table table-striped table-bordered table-highlight table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM users";

            $users = $crud->get_all_data($query);
            ?>
            <?php 
            $no = 1;
            foreach ($users as $user): ?>
                <tr id="user-<?php echo $no; ?>">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $user['user']; ?></td>                
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a class="btn btn-info btn-sm" href="task_edit.php?edit_id=<?php print($user['user']); ?>">Edit</a>                        
                        <a class="btn btn-warning btn-sm" href="task_view.php?view_id=<?php print($user['user']); ?>">View</a>                        
                        <a class="btn btn-danger btn-sm" href="task_delete.php?delete_id=<?php print($user['user']); ?>" onClick="return confirm('are you sure you want to delete?');">Delete</a>                        
                    </td>
                </tr>
            <?php $no++;?>
            <?php endforeach; ?>

        </tbody>
    </table>

</div>