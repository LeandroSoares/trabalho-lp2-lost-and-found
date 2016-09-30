<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTag.php';

class VCoreTagContainer extends VCoreTag{

    protected $content;
    private $tag;
    public function __construct($tag, $content='') {
        $this->content = $content;
        $this->tag = $tag;
        parent::__construct($tag);
    }

    /**
     * setContent - atribui conteudo sobreescrevendo
     *
     * @param  {string} $content
     * @return {BaseTag}
     */
    protected function setContent($content) {
        $this->content=$content;
        return $this;
    }

    /**
     * appendContent - adiciona conteudo no final
     *
     * @param  {string} $content: string html de conteudo a ser adicionado
     * @return {BaseTag}
     */
    public function appendContent($content){
        $this->content .= $content;
        return $this;
    }

    /**
     * prependContent - adiciona conteudo no inicio
     *
     * @param  {string} $content: string html de conteudo a ser adicionado
     * @return {BaseTag}
     */
    public function prependContent($content){
        $this->content = $content . $this->content;
        return $this;
    }

    /**
     * getHTML - retorna string de html
     *
     * @return {string}
     */
    public function getHTML() {
        $html = parent::getHTML();
        $html.="{$this->content}</{$this->tag}>";
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
