<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

/**
 * Classe para renderizar h1, h2, h3 ....
 */
class VHx extends VCoreTagContainer{

    public function __construct($texto, $nivel=1) {
        parent::__construct('h'.$nivel, $texto);
    }
}
