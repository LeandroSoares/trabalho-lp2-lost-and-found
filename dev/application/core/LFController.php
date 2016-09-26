<?php defined('BASEPATH') OR exit('No direct script access allowed');

class LFController extends CI_Controller {


    private $data=array();

    protected function dataAdd($key, $val) {
        $this->data[$key]=$val;
    }

    protected function clearData() {
        $this->data=array();
    }

    public function __construct() {
        parent::__construct();
        $this->load->helper ( 'form' );
        $this->load->helper ( 'url' );
        $this->load->helper ( 'security' );
        $this->load->helper ( 'language' );
        $this->load->library('form_validation');

    }

    public function index() {
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $this->dataAdd('username', $session_data['username']);
            $this->dataAdd('login', true);
        }
        else {
            $this->dataAdd('login', false);
        }

        $this->load->view('common/header', $this->data);
    }

    function loadFooter($params='') {
        $this->load->view('common/footer', $params);
    }

    function logout() {
       $this->session->unset_userdata('logged_in');
       session_destroy();
       redirect(base_url(), 'refresh');
       $this->clearData();
    }
}
