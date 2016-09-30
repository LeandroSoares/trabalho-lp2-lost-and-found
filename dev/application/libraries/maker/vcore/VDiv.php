<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VDiv - Classe para renderizar a marcação html "div"
 */
class VDiv extends VCoreTagContainer{

    function __construct($content="") {
        parent::__construct('div', $content);
    }

}
