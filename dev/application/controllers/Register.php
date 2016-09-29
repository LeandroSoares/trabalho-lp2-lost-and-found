<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends LFController {
    public function __construct() {
        parent::__construct();
        $this->load->model('ObjectModel', 'model');
        $this->load->library('form_validation');
    }

    public function lost() {
        $this->dataAdd('register', 'lost');

        loadView();
    }

    public function found() {
        $this->dataAdd('register', 'found');

        loadView();
    }
    function loadView() {
        $this->index();
        $this->load->view('register');
        $this->loadFooter();
    }
}
