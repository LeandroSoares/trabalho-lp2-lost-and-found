<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends LFController {
    function index() {
        parent::index();
        $this->load->view('home');
        $this->loadFooter();
    }
}
