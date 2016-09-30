<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VP - Classe para renderizar a marcação html "p"
 */
class VP extends VCoreTagContainer{

    function __construct($content="") {
        parent::__construct('p', $content);
    }

}
