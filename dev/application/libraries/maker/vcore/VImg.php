<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTag.php';

class VImg extends VCoreTag{
    private $isBase64;
    private $src;
    private $attributeList;
    public function __construct($src="", $isBase64=false) {
        $this->isBase64=false;
        $this->src=$src;
        $this->setBase64();
        $this->attributeList=array();
        parent::__construct('img', "");
    }
    public function setBase64() {
        if($this->isBase64)return;
        $this->isBase64=true;
        $this->src = 'data:image/jpeg;base64,'.base64_encode($this->src);
    }
    public function getHTML() {
        $this->addAttr("src", $this->src);
        return parent::getHTML();
    }
}
