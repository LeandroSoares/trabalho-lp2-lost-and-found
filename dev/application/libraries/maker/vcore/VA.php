<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'VCoreTagContainer.php';
/**
 * @author Leandro Soares  <leandrogamedesigner@gmail.com>
 *
 * VA - Classe para renderizar a marcação html "a"
 */
class VA extends VCoreTagContainer{

    /**
     * __construct -
     *
     * @param  {string} $content
     * @param  {string} $href
     * @return {VA}
     */
    function __construct($content="", $href="", $class="") {
        parent::__construct('a', $content);
        if(isset($href))
            $this->attr('href', $href);
        if(isset($class))
            $this->addClass($class);
        return $this;
    }
}
