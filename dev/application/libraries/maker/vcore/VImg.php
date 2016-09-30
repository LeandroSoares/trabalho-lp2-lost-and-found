<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTag.php';

/**
 * VImg
 * Classe para renderizar img
 * - src
 * - base64
 */
class VImg extends VCoreTag{
    private $isBase64;
    private $src;

    public function __construct($src="", $isBase64=false) {
        $this->isBase64=$isBase64;
        $this->src=$src;
        parent::__construct('img', "");
    }

    /**
     * setBase64 - atribui caracteristica de imagem isBase64
     *
     * @return {void}
     */
    public function setBase64($value=true) {
        $this->isBase64 = $value;
    }
    private function getSrc(){
        $src = $this->src;
        if($this->isBase64){
            $src = 'data:image/jpeg;base64,'.base64_encode($this->src);
        }
        return $src;
    }
    public function getHTML() {
        $this->attr("src", $this->getSrc());
        return parent::getHTML();
    }
}
