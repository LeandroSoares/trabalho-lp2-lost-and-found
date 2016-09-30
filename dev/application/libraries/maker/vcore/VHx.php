<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

class VHx extends VCoreTagContainer{

    public function __construct($texto, $nivel=1) {
        parent::__construct('h'.$nivel, $texto);
    }
}
