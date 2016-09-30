<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTag.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VImg - Classe para renderizar a marcação html "img"
 */
class VImg extends VCoreTag {
    private $isBase64;
    private $src;

    /**
     * __construct
     *
     * @param  {string}  $src       opcional - url da imagem a ser renderizada
     * @param  {boolean} $isBase64  opcional - define se o valor de src deve ser interpretado como base64
     * @return {VImg}
     */
    public function __construct($src="", $isBase64=false) {
        $this->isBase64=$isBase64;
        $this->src=$src;
        parent::__construct('img', "");
        return $this;
    }

    /**
     * setBase64 - define se o valor de src deve ser interpretado como base64
     *
     * @return {void}
     */
    public function setBase64($value=true) {
        $this->isBase64 = $value;
    }

    /**
     * getSrc - renderiza o valor de src
     *
     * @return {string}  description
     */
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
