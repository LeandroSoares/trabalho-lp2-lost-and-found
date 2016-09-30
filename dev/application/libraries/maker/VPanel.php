<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once 'vcore/VDiv.php';
require_once 'vcore/VHx.php';
require_once 'vcore/VP.php';
require_once 'vcore/VImg.php';
require_once 'vcore/VButton.php';

class VPanel extends VDiv{
    public $header;
    public $body;
    public $footer;

    function __construct() {
        parent::__construct("");
        $this->addClass('panel')->addClass('panel-default');
        $this->header = new VDiv();
        $this->header->addClass('panel-heading');
        $this->body = new VDiv();
        $this->body->addClass('panel-body');
        $this->footer = new VDiv();
        $this->footer->addClass('panel-footer');
    }
    public function getHTML() {
        $this->setContent($this->header->getHTML());
        $this->appendContent($this->body->getHTML());
        $this->appendContent($this->footer->getHTML());
        return parent::getHTML();
    }

}
