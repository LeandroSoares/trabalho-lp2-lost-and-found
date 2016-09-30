<?php
    //criando container principal
    $container = new VDiv();
        $container->addClass('container');

    //capturando mensagem de objeto registrado
    $register_status_code = $this->session->flashdata('register_status');
    $register_status_message = $this->session->flashdata('register_message');
    //caso exista status
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
    //criando row para abrigar search box
    $headmessage = new VHx('Procure pelo seu objeto perdido!', 3);
        $headmessage->addClass('panel lead');
    if(isset($searchquery)){
        $headmessage->setContent('Resultado da busca por: '.$searchquery);
    }
    //criando row para abrigar search box
    $rowsearch = new VDiv();
    $rowsearch->addClass('panel');
    $rowsearch->appendContent(form_open_multipart(base_url('objectlist')));
    $rowsearch->appendContent('<div class="input-group col-sm-12"> <input type="text" name="searchquery" class="search-query form-control" placeholder="Search" /> <span class="input-group-btn"> <button type="submit" class="btn btn-primary"> <span class=" glyphicon glyphicon-search"></span> </button> </span> </div>');
    $rowsearch->appendContent(form_close());

    //criando row para abrigar objetos
    $row = new VDiv();
        $row->addClass('list');

    //loop para listar todos objetos com o modelo visual VObjectPanel
    // e inserir na row
    foreach ($lista as $value) {

        $panel = new VObjectPanel();
        $panel->setData($value)
              ->addClass('col-sm-12');
        $row->prependContent($panel->getHTML());
    }
    // adicionando row no container principal
    $container->appendContent($headmessage->getHTML());
    $container->appendContent($rowsearch->getHTML());
    $container->appendContent($row->getHTML());
    //renderizando conteiner
    $container->render();
