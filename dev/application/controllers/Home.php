<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends LFController {
    function index() {
        parent::index();

        $vlibs[]='maker/vcore/VDiv';
        $vlibs[]='maker/vcore/VHx';
        $vlibs[]='maker/vcore/VP';
        $vlibs[]='maker/vcore/VA';

        $this->load->library($vlibs);

        $this->load->view('home');
        $this->loadFooter();
    }
}
