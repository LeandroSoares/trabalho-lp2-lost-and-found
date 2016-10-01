<?php
defined('BASEPATH') OR exit('No direct script access allowed');

requireLib("maker/vcore/VCoreTagContainer");

// require_once APPPATH.'/libraries/maker/vcore/VCoreTagContainer.php';

/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 */


class VFormSelect extends VCoreTagContainer{

    function __construct($options=array(), $value="", $attrList=array()) {
        parent::__construct("select");
        foreach ($options as $key => $text) {
            $option = new VCoreTagContainer('option', $text);
            $option->attr('value', $key);
            if($value == $key){
                $option->attr('selected', 'selected');
            }
            $this->appendContent($option);
        }
        $this->attrList($attrList);
    }
}
