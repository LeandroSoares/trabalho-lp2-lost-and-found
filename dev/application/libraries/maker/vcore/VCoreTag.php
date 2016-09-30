<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'IVCore.php';
/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VCoreTag
 * Tem a responsabilidade de gerenciar a marcacao de html
 * Compreende:
 *  - Tipo de marcação html
 *  - Atributos
 *  - Id
 *  - Classe
 */
class VCoreTag  implements IVCore{
    protected $CI;
    private $tag;
    private $classList;
    private $attributeList;
    private $id;

    public function __construct($tag) {
        $this->ci=get_instance();
        $this->tag=$tag;
        $this->classList=array();
        $this->attributeList=array();
        $this->id="";
    }

    /**
     * getId - retona id
     *
     * @return {type}  description
     */
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id=$id;
        return $this;
    }
    /**
     * addClass - adiciona uma classe ao elemento
     *
     * @param  {string} $class classe de css
     * @return {BaseTag}
     */
    public function addClass($class) {
        $this->classList[]=$class;
        return $this;
    }
    /**
     * addAttr - adiciona um atributo
     *
     * @param  {string} $attr
     * @param  {string} $value
     * @return {BaseTag}
     */

    public function attr($attr, $value) {
        $this->attributeList[$attr]=$value;
        return $this;
    }

    /**
     * getClasses - retorna as classes para string html
     *
     * @return {string}
     */
    protected function getClasses() {
        $clist='';
        $length = count($this->classList);

        if($length > 0 ){
            $clist = 'class="' . implode(" ", $this->classList) . '"';
        }
        return $clist;
    }

    /**
     * getAttributes - retorna as classes para string html
     *
     * @return {string}
     */
    protected function getAttributes() {
        $list='';
        foreach ($this->attributeList as $key => $value) {
            $list.="$key=\"$value\"";
        }
        return $list;
    }

    /**
     * getHTML - retorna string de html
     *
     * @return {string}
     */
    public function getHTML() {
        return "<{$this->tag} {$this->getId()} {$this->getClasses()} {$this->getAttributes()} >";
    }
    protected function getEndTagHTML() {
        return "</{$this->tag}>";
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
