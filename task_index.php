<?php
include_once 'inc/inc.config.php';
include_once 'inc/inc.header.php';
use MyConfig\Config;

$config = new Config();
$user = $config->user;
$crud = $config->crud;

if (!$user->is_loggedin()) {
    $user->redirect('index.php');
}
?>

<div class="row mzm">    
    <div class="btn-group pull-right" role="group" aria-label="...">
        <a class="btn btn-info" href="task_add.php">Add Data</a>
    </div>
    <table id="index_users" class="table table-striped table-bordered table-highlight table-hover">
        <thead>
            <tr>
                <th>#</th>
                <th>Task Name</th>
                <th>Image Path</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM tasks";

            $tasks = $crud->get_all_data($query);
            ?>
            <?php if (!empty($tasks)) :?>
            <?php 
            $no = 1;
            foreach ($tasks as $task): ?>
                <tr id="task-<?php echo $task['task_id']; ?>">
                    <td><?php echo $no; ?></td>
                    <td><?php echo $task['name']; ?></td>                
                    <td><?php echo $task['image']; ?></td>
                    <td>
                        <a class="btn btn-info btn-sm" href="task_edit.php?edit_id=<?php print($task['task_id']); ?>">Edit</a>                        
                        <a class="btn btn-danger btn-sm" href="task_delete.php?delete_id=<?php print($task['task_id']); ?>" onClick="return confirm('are you sure you want to delete?');">Delete</a>                        
                    </td>
                </tr>
            <?php $no++;?>
            <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

</div>