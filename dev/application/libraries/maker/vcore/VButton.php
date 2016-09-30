<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';
/**
 * Class VP: cria uma tag html do tipo button
 */
class VButton extends VCoreTagContainer{

    function __construct($content="") {
        parent::__construct('button', $content);
    }

}
