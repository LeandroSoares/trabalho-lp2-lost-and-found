<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'VPanel.php';
require_once 'vcore/VA.php';

class VObjectPanel extends VPanel{

    private $data;

    /**
     * setData - atribui os dados ObjectDataModel
     *
     * @param  {ObjectDataModel} $data
     * @return {VObjectPanel}
     */
    public function setData($data) {
        $this->data = $data;
        $this->setDataHTML($data);
        return $this;
    }

    /**
     * setDataHTML - processa os dados ObjectDataModel e transforma em string html
     *
     * @param  {ObjectDataModel} $data
     * @return {VObjectPanel}
     */
    private function setDataHTML($data) {

        $this->body->addClass('flex-box');
        $this->footer->addClass('flex-box justify-right');
        //criando titulo
        $title = new VHx("#".$data->getCode()." - ".$data->getName()." status: ".$data->getStatus(),4);
        $title->addClass('panel-title');
        //criando conteiners para divisao de conteudo
        $left = new VDiv();
        $left->addClass('flex-box');
        $left->addClass('justify-center');

        $right = new VDiv();
        $right->addClass('flex-box');
        $right->addClass('align-center');
        $right->addClass('justify-center');
        //criando imagem
        $image = new VImg($data->getImage());
        $image->setBase64(true);
        //criando descricao
        $description= new VP($data->getDescription());
        //criando botao em relacao ao status
        switch($data->getStatuscode()){
            case 1:
                $btnaction = new VA("Achei este item",base_url('found/'.$data->getCode()."/".$data->getStatuscode()));
                $btnaction->addClass('btn btn-success');
                $this->footer->appendContent($btnaction->getHTML());
            break;
            case 2:
                $btnaction = new VButton("Perdi este item");
                $btnaction->addClass('btn btn-warning');
                $this->footer->appendContent($btnaction->getHTML());
            break;
        }
        $this->header->appendContent($title->getHTML());

            $left->appendContent($image->getHTML());
            $right->appendContent($description->getHTML());

        $this->body->appendContent($left->getHTML());
        $this->body->appendContent($right->getHTML());

        return $this;
    }

}
