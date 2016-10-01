<?php
    $container = new VDiv();
        $container->addClass('container');
        $panel = new VPanel();

        if(isset($customerror)){
            $alert = new VDiv(validation_errors());
            $alert->appendContent($customerror);
            $alert->addClass('alert alert-danger');
            $panel->body->prependContent($alert->getHTML());
        }
        $panel->prependContent(form_open_multipart('signin'));
            $panel->header->appendContent(new VHx('Signin', 3, 'panel-title'));
            foreach($form_model as $key => $value){
                $formGroup = new VBootstrapFormGroup();
                $formGroup->label->appendContent($key);
                $value['class']='form-control';
                $formGroup->appendContent(form_input($value));
                $panel->body->appendContent($formGroup);
            }
            $panel->footer->appendContent(new VButton("Signin", "btn btn-primary pull-right", "submit"));
            $panel->footer->appendContent(new VDiv('','clearfix'));
        $panel->appendContent(form_close());
    $container->appendContent($panel);
    $container->render();
?>
