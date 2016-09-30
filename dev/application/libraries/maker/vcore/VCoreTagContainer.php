<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'VCoreTag.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VCoreTagContainer
 * Tem a responsabilidade de gerenciar o conteudo das tags html
 */
class VCoreTagContainer extends VCoreTag {

    /**
     *  @var {array} $content - Array que guarda todo conteudo a ser renderizado
     */
    protected $content;

    /**
     * __construct - instancia um objeto VCoreTagContainer:IVCore
     *
     * @param  {string}         $tag        obrigatório, define a tag de marcação html
     * @param  {string|IVCore}  $content='' opcional, conteúdo a ser inserido dentro da tag
     * @return {VCoreTagContainer}          description
     */
    public function __construct($tag, $content='') {
        $this->content = array($content);
        parent::__construct($tag);
        return $this;
    }

    /**
     * setContent - atribui conteudo sobreescrevendo
     *
     * @param  {string|IVCore} $content: string html,
     *         ou Objecto com interface IVCore a ser atribuido
     * @return {VCoreTagContainer}
     */
    public function setContent($content) {
        $this->content=array($content);
        return $this;
    }

    /**
     * clearContent - remove todo conteudo existente
     *
     * @return {void}
     */
    public function clearContent() {
        $this->content=array();
        return $this;
    }

    /**
     * appendContent - adiciona conteudo no final
     *
     * @param  {string|IVCore} $content: string html,
     *         ou Objecto com interface IVCore a ser adicionado
     * @return {VCoreTagContainer}
     */
    public function appendContent($content){
        array_push($this->content, $content);
        return $this;
    }

    /**
     * prependContent - adiciona conteudo no inicio
     *
     * @param  {string|IVCore} $content: string html,
     *         ou Objecto com interface IVCore a ser adicionado
     * @return {VCoreTagContainer}
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
        // Percorrendo todo o array de conteúdo
        foreach ($this->content as $content) {
            //Como o conteudo pode ser string ou objeto com interface IVCore
            if(gettype($content)=='string'){
                    $html.=$content;
            } else {
                $html.= $content->getHTML();
            }
        }
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
