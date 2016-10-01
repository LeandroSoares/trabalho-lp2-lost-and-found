<?php
    //criando container principal
    $container = new VDiv('','container');

        $jumbotron = new VDiv('','jumbotron');
        $container->appendContent($jumbotron);

        $jumbotron->appendContent(new VHx('Lost & Found',1));
        $jumbotron->appendContent(new VP('O sistema Lost & Found tem o objetivo de ajudar as pessoas encontrarem seus pertences perdidos.'));
        $jumbotron->appendContent(new VP('Pode ser implementado em qualquer lugar pois é free!'));
        $jumbotron->appendContent("<br/>");
            $row = new VDiv('','row');

            $jumbotron->appendContent($row);

            $row->appendContent(new VDiv(new VA('Perdeu algo ?',base_url('objectregister'),'col-sm-offset-4 btn btn-danger btn-lg'),'col-sm-6'));

            if(!$login){
                $row->appendContent(new VDiv(new VA('Cadastre-se',base_url('signin'),'col-sm-offset-4 btn btn-success btn-lg'),'col-sm-6'));
            }

    $container->render();
