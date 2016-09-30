<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';

/**
 * Class VP: cria uma tag html do tipo paragrafo
 */
class VP extends VCoreTagContainer{

    function __construct($content="") {
        parent::__construct('p', $content);
    }

}
