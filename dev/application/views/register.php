<?php

    $container = new VDiv();
    $container->addClass('container');
        $panel = new VPanel();
        $panel->prependContent(form_open_multipart($action));
            $panel->header->appendContent('<h3 class="panel-title">Registrar objeto</h3>');
            $message="";
            if(isset($error)) {
                $message="<div class=\"alert alert-warning\" role=\"alert\">".validation_errors()."</div>";
            }
            if(isset($success)) {
                $message= "<div class=\"alert alert-success\" role=\"alert\">$success</div>";
            }

            $panel->body->appendContent($message);

            $divRenderfactory = new VDiv();
            $divRenderfactory->addClass('form-group');
            // $labelfactory->addClass('form-group');
            foreach($form_model as $key => $value) {
                $divRenderfactory->clearContent();
                $divRenderfactory->setContent("<label>$key</label>");
                $value['class']='form-control';
                if($value['type']!='select'){
                    $divRenderfactory->appendContent( form_input($value,set_value($value['name'])) );
                }
                else{
                    $divRenderfactory->appendContent(form_dropdown($value['name'],$value['options'], set_value($value['name'])));
                }
                $panel->body->appendContent($divRenderfactory->getHTML());
            }
            //limpando a factory
            $divRenderfactory->setContent("");

            $panel->footer->appendContent('<button type="submit" class="btn btn-success pull-right ">Confirmar</button>');
            $panel->footer->appendContent('<div class="clearfix"></div>');
        $panel->appendContent(form_close());
    $container->appendContent($panel->getHTML());
    $container->render();

?>
<!-- <div class="container">
<div class="panel panel-default">
    <div class="">
        <div class="panel-heading">
            <h3 class="panel-title ">Registrar objeto</h3>
        </div>
        <div class="panel-body">
            <?php
                if(isset($error)) {
                    echo "<div class=\"alert alert-warning\" role=\"alert\">".validation_errors()."</div>";
                }
                if(isset($success)) {
                    echo "<div class=\"alert alert-success\" role=\"alert\">$success</div>";
                }
            ?>
            <?php
                echo form_open_multipart($action);
                foreach($form_model as $key => $value):
                    ?>
                    <div class="form-group">
                        <label><?php echo $key; ?></label>
                        <?php
                        //adicionando valor de classe para a strutura de dados do input
                        $value['class']='form-control';
                            if($value['type']!='select'){
                                //usando o helper do Ci para criar o input
                                echo form_input($value,set_value($value['name']));
                            }
                            else{
                                echo form_dropdown($value['name'],$value['options'], set_value($value['name']));
                            }
                        ?>
                    </div>

                        <?php endforeach;?>
                <div class="container-fluid">
                    <div class="row form-group">
                        <button type="submit" class="btn btn-default pull-right">Confirmar</button>
                    </div>
                </div>

            <?php echo form_close();?>
        </div>
    </div>
</div>
</div> -->
