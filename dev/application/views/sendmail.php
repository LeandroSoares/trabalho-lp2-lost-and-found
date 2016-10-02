<?php
    $container = new VDiv();
        $container->addClass('container');
        $panel = new VPanel();

        if(isset($formerror)){
            $panel->body->prependContent(new VDiv(validation_errors(), 'alert alert-danger'));
        }
        $panel->prependContent(form_open_multipart(base_url(uri_string())));
            $panel->header->appendContent(new VHx('Mandar mensagem', 4, "panel-title"));
            $panel->body->appendContent(new VP('Para que o objeto possa retornar ao seu dono, recomendamos que mande uma mensagem para combinar uma forma de devolver o objeto.','col-md-8'));
            $panel->body->appendContent('<div class="clearfix"></div>');
            $panel->body->appendContent('<div class="form-group"> <label for="comment">Mensagem:</label> <textarea class="form-control" rows="5" id="comment" name="message"></textarea> </div>');
            $panel->footer->appendContent(new VButton("Enviar email <span class=\"glyphicon glyphicon-send\"></span>","btn btn-success pull-right","submit"));
            $panel->footer->appendContent(new VA("Cancelar <span class=\"glyphicon glyphicon-remove\"></span>",base_url('objectlist'),"btn btn-danger pull-left"));

            $panel->footer->appendContent('<div class="clearfix"></div>');
        $panel->appendContent(form_close());
    $container->appendContent($panel->getHTML());
    $container->render();
?>
