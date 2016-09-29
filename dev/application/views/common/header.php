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
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css');?>" media="screen" title="no title">
        <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css');?>" media="screen" title="no title">
        <link rel="stylesheet" href="<?php echo base_url('css/style.css');?>" media="screen" title="no title">

        <script src="<?php echo base_url('js/jquery.min.js')?>" charset="utf-8"></script>
        <script src="<?php echo base_url('js/bootstrap.min.js')?>" charset="utf-8"></script>
    </head>

    <body>
        <nav class="navbar navbar-default navbar-fixed-top">
          <div class="container-fluid">
            <div class="navbar-header">
              <a class="navbar-brand" href="#"> Lost & Found </a>
            </div>
            <ul class='nav navbar-nav navbar-right'>
                <li><a href="#">Home</a></li>
                <li><a href="#">Objetos perdidos</a></li>
                <li><a href="#">Registrar perdido</a></li>
                <li><a href="#">Registrar achado</a></li>
                <?php if(!$login):?>
                <li><a href="#" data-toggle="modal" data-target="#login-modal">Login</a></li>
                <?php else:?>
                <li class='alert-info'><a href="#"><?php echo $username; ?></a></li>
                <li><a href="logout">Logout</a></li>
                <?php endif;?>
            </ul>
          </div>
        </nav>

        <?php if(!$login):?>

        <div class="modal fade" id="login-modal" role="dialog">
            <div class="modal-dialog">
                  <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    <?php if($loginerror):?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php endif;?>
                <form action="<?php echo base_url('login')?>" method="post">

                    <div class="form-group">
                        <label for="user">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="username">
                    </div>
                    <div class="form-group">
                        <label for="pass">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="username">
                    </div>

                    <div class="container-fluid">
                        <div class="row form-group">
                            <a href='<?php echo base_url('signin')?>'>Sign in ?</a>
                            <button type="submit" class="btn btn-primary pull-right">Login</button>
                        </div>
                    </div>
                </form>
                </div>
              </div>
            </div>
        </div>
        <?php if($loginerror):?>
        <script> $('#login-modal').modal('show');</script>
        <?php endif;?>

        <?php endif;?>
