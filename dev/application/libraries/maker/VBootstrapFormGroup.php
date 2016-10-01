<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vcore/VCoreTagContainer.php';
require_once 'vcore/VDiv.php';


/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 */

/**
 * Atalho para strutura de formgroup do  bootstrap
 */
class VBootstrapFormGroup extends VDiv{

    public $label;

    function __construct() {
        parent::__construct("");
        $this->addClass('form-group');
        $this->label = new VCoreTagContainer('label');
        $this->appendContent($this->label);
    }
}
