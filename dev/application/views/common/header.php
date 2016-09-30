<?php
    if(!isset($loginerror))
        $loginerror = false;
    if(!isset($login))
        $login = false;

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">

        <title>Lost & Found</title>

        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css');?>">
        <link rel="stylesheet" href="<?php echo base_url('css/style.css');?>">

        <script src="<?php echo base_url('js/jquery.min.js')?>" charset="utf-8"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js')?>" charset="utf-8"></script>
        <script src="<?php echo base_url('js/main.js')?>" charset="utf-8"></script>

    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"> Lost & Found </a>
            </div>
            <ul class='nav navbar-nav navbar-right'>
                <li><a href="<?=base_url()?>">Home</a></li>
                <li><a href="<?=base_url('objectlist')?>">Objetos perdidos</a></li>
                <li><a href="<?=base_url('objectregister')?>">Registrar objeto</a></li>

                <?php if(!$login):?>
                    <li><a href="<?=base_url('login')?>">Login</a></li>
                <?php else:?>
                    <li class='alert-info'><a href="#"><?php echo $username; ?></a></li>
                    <li><a href="<?=base_url('logout')?>">Logout</a></li>
                <?php endif;?>

            </ul>
          </div>
        </nav>
