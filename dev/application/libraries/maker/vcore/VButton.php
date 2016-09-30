<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VButton - Classe para renderizar a marcação html "button"
 */
class VButton extends VCoreTagContainer{

    function __construct($content="") {
        parent::__construct('button', $content);
    }
}
