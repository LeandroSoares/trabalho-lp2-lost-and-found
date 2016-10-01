<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VHx - Classe para renderizar a marcação html "h"
 */
class VHx extends VCoreTagContainer{

    public function __construct($content='', $nivel=1, $class='') {
        parent::__construct('h'.$nivel, $content);
        if(isset($class))
            $this->addClass($class);
    }
}
