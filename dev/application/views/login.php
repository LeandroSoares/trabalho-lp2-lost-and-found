<?php
    $container = new VDiv();
        $container->addClass('container');
        $panel = new VPanel();

        if(isset($loginerror)){
            $panel->body->prependContent(new VDiv(validation_errors(), 'alert alert-danger'));
        }
        $signinSuccess = $this->session->flashdata('signin');
        if(isset($signinSuccess)){
            $panel->body->prependContent(new VDiv($signinSuccess, 'alert alert-success'));
        }

        $panel->prependContent(form_open_multipart('login'));
            $panel->header->appendContent('<h3 class="panel-title ">Login</h3>');
            $panel->body->appendContent('<div class="form-group"> <label for="user">Username</label> <input type="text" class="form-control" name="username" placeholder="username"> </div>');
            $panel->body->appendContent('<div class="form-group"> <label for="pass">Password</label> <input type="password" class="form-control" name="password" placeholder="username"> </div>');
            $panel->footer->appendContent('<a href="'.base_url('signin').'" class="btn btn-warning ">Sign in</a>');
            $panel->footer->appendContent('<button type="submit" class="btn btn-primary pull-right ">Login</button>');
            $panel->footer->appendContent('<div class="clearfix"></div>');
        $panel->appendContent(form_close());
    $container->appendContent($panel->getHTML());
    $container->render();
?>
