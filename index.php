<?php
include_once 'inc/inc.config.php';

if ($user->is_loggedin() != "") {
    $user->redirect('task_index.php');
}else{
    $user->redirect('login.php');
}