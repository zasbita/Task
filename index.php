<?php
include_once 'inc/inc.config.php';
use MyConfig\Config;

$config = new Config();
$user = $config->user;

if ($user->is_loggedin() != "") {
    $user->redirect('task_index.php');
}else{
    $user->redirect('login.php');
}