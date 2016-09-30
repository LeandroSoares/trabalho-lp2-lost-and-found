<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';
/**
 * Class VP: cria uma tag html do tipo anchor
 */
class VA extends VCoreTagContainer{

    function __construct($content="", $href="") {
        parent::__construct('a', $content);
        if($href!="")
            $this->addAttr('href', $href);
    }
}
