<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @name ORDENADA
 */
define("ORDENADA", 'ol');
/**
 * @name NAO_ORDENADA
 */
define("NAO_ORDENADA", 'ul');

require_once 'VCoreTagContainer.php';
/**
 * @class Lista cria uma lista html
 *
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 * @prontuario 156253-3
 *
 * @param string $ordenada
 * recebe valores ORDENADA ou NAO_ORDENADA
 */
class VList extends VCoreTagContainer{

    private $itens;

    function __construct($ordenada=NAO_ORDENADA) {
        $this->itens=array();
        parent::__construct($ordenada, '');
    }

    public function addItem($item) {
        $this -> itens[] = $item;
        $this->appendListItem($item);
    }

    public function removeItem($index) {
        array_splice($this->itens, $index, 1);
        $this->renderize();
    }

    private function appendListItem($content) {
        $liItem = new VCoreTagContainer('li', $content);
        $this -> appendContent($liItem->getHTML());
    }

    private function renderize() {
        $this->setContent('');
        foreach ($this->itens as $item) {
            $this->appendListItem($item);
        }
    }
}
