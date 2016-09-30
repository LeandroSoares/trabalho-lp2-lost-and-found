<?php
    //criando container principal
    $container = new VDiv();
        $container->addClass('container');
    //capturando mensagem de objeto registrado
    $register_status_code = $this->session->flashdata('register_status');
    $register_status_message = $this->session->flashdata('register_message');

    if($register_status_code > 0){
        $message = new VDiv($register_status_message);
        $message->addClass('alert');
        $message->addClass('alert-temp');
        if($register_status_code==1){
            $message->addClass('alert-success');
        } else {
            $message->addClass('alert-warning');
        }
        $container->appendContent($message->getHTML());
    }

    //criando row para abrigar objetos
    $row = new VDiv();
        $row->addClass('list');

    //loop para listar todos objetos com o modelo visual VObjectPanel
    // e inserir na row
    foreach ($lista as $value) {

        $panel = new VObjectPanel();
        $panel->setData($value)
              ->addClass('col-md-4');

        $row->prependContent($panel->getHTML());
    }
    // adicionando row no container principal
    $container->appendContent($row->getHTML());
    //renderizando conteiner
    $container->render();
