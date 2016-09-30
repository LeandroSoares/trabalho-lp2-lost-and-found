<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'VCoreTagContainer.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 * VList cria uma lista com marcação html "ul" ou "ol"
 */
class VList extends VCoreTagContainer{

    /**
     * __construct
     *
     * @param  {boolean} $ordenada  - default:false
     *                                define se é uma lista ordenada ou não. default:false
     * @return {VList}
     */
    function __construct($ordenada=false) {
        $this->itens=array();
        $listMarkup = $ordenada?"ol":"ul";
        parent::__construct($listMarkup, '');
        return $this;
    }

    /**
     * addItem - adiciona automatiamente o conteúdo a um li e insere na lista
     *
     * @param  {string|IVCore} $content description
     * @return {VList}       description
     */
    public function addItem($content) {
        $liItem = new VCoreTagContainer('li', $content);
        $this -> appendContent($liItem);
        return $this;
    }
}
