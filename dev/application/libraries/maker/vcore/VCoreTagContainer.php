<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'IVCore.php';
require_once 'VCoreTag.php';

/**
 * VCoreTagContainer
 * Tem a responsabilidade de gerenciar o conteudo das tags html
 */
class VCoreTagContainer extends VCoreTag implements IVCore {

    protected $content;

    public function __construct($tag, $content='') {
        $this->content = array($content);
        parent::__construct($tag);
    }

    /**
     * setContent - atribui conteudo sobreescrevendo
     *
     * @param  {IVCore} $content
     * @return {BaseTag}
     */
    public function setContent($content) {
        $this->content=array($content);
        return $this;
    }

    public function clearContent() {
        $this->content=array();
        return $this;
    }

    /**
     * appendContent - adiciona conteudo no final
     *
     * @param  {string} $content: string html de conteudo a ser adicionado
     * @return {BaseTag}
     */
    public function appendContent($content){
        array_push($this->content, $content);
        return $this;
    }

    /**
     * prependContent - adiciona conteudo no inicio
     *
     * @param  {string} $content: string html de conteudo a ser adicionado
     * @return {BaseTag}
     */
    public function prependContent($content){
        array_unshift($this->content, $content);
        return $this;
    }

    /**
     * getHTML - retorna string de html
     *
     * @return {string}
     */
    public function getHTML() {
        $html = parent::getHTML();
        $html.= implode("", $this->content);
        $html.= $this->getEndTagHTML();
        return $html;
    }

    /**
     * render - renderiza o html gerado por essa classe na tela
     *
     * @return {void}
     */
    public function render() {
        echo $this->getHTML();
    }

}
