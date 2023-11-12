<?php
    include_once 'inc/inc.config.php';
    use MyConfig\Config;
    
    $config = new Config();
    $user = $config->user;
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Task to do</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" media="screen"> 
        <!-- Custome -->
        <link href="css/style.css" rel="stylesheet"> 
    </head>

    <body>
        <!-- Main content -->
        <div class="container">
            <?php if ($user->is_loggedin() != "") { ?>
                <!--Main header -->
                <div class="header clearfix">
                    <!--Nav -->
                    <nav>
                        <ul class="nav nav-pills pull-right">
                            <li class="active" role="presentation"><a href="task_index.php">Task to do</a></li>                        
                            <li class="active" role="presentation"><a href="logout.php?logout">Logout</a></li>                        
                        </ul>
                    </nav>
                    <!-- /.nav -->
                    <h3 class="text-muted">Welcome : <?php echo $_COOKIE['user']; ?></h3>
                </div>
                <!-- /.header -->
            <?php } ?>
