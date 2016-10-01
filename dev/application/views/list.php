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
    }else {
        $searchquery='';
    }
    //criando row para abrigar search box
    $rowsearch = new VDiv();
    $rowsearch->addClass('panel');
    $rowsearch->appendContent(form_open_multipart(base_url('objectlist')));
    $rowsearch->appendContent('<div class="input-group col-sm-12"> <input autofocus type="text" name="searchquery" value="'.$searchquery.'" class="search-query form-control" placeholder="Search" /> <span class="input-group-btn"> <button type="submit" class="btn btn-primary"> <span class=" glyphicon glyphicon-search"></span> </button> </span> </div>');
    $rowsearch->appendContent(form_close());

    //criando row para abrigar objetos
    $row = new VDiv();
        $row->addClass('list');

    //loop para listar todos objetos
    // e inserir na row
    foreach ($lista as $data) {
        $panel = new VPanel();
        $panel->addClass('col-sm-12');
        $panel->body->addClass('flex-box');
        $panel->footer->addClass('flex-box justify-right');
        //criando titulo
        $title = new VHx("#".$data->getCode()." - ".$data->getName()." status: ".$data->getStatus(), 4);
        $title->addClass('panel-title');
        //criando conteiners para divisao de conteudo
        $left = new VDiv();
        $left->addClass('flex-box justify-center');

        $right = new VDiv();
        $right->addClass('flex-box justify-center align-center');

        //criando imagem
        $image = new VImg($data->getImage(), true);

        //criando descricao
        $description= new VP($data->getDescription());

        //criando botao em relacao ao status
        if($data->getStatuscode()>0){
            $btnaction = new VA("",base_url('found/'.$data->getCode()."/".$data->getStatuscode()));
            if($data->getStatuscode()==1){
                $btnaction->setContent("Achei este item!");
                $btnaction->addClass('btn btn-success');
            }else if($data->getStatuscode()==2){
                $btnaction->setContent("Perdi este item!");
                $btnaction->addClass('btn btn-warning');
            }
            $panel->footer->appendContent($btnaction);
        }

        $panel->header->appendContent($title);

          $left->appendContent($image);
          $right->appendContent($description);

        $panel->body->appendContent($left);
        $panel->body->appendContent($right);
        $row->prependContent($panel);
    }
    // adicionando row no container principal
    $container->appendContent($headmessage->getHTML());
    $container->appendContent($rowsearch->getHTML());
    $container->appendContent($row->getHTML());
    //renderizando conteiner
    $container->render();
