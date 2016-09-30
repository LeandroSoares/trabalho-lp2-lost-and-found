<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

/**
 * Classe para renderizar divs
 */
class VDiv extends VCoreTagContainer{

    function __construct($content="") {
        parent::__construct('div', $content);
    }

}
