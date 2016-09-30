<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends LFController {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel', 'user');
        $this->load->library('form_validation');
    }

    function index() {
        $this->setValidationRules();
        if(!$this->validateForm()) {
            $this->dataAdd('loginerror', true);
        }
        else if(!empty($this->input->post())){
            redirect(base_url(), 'refresh');
        }
        parent::index();
        $this->load->view('home');
        $this->loadFooter();
    }

    public function validateForm() {
        return $this->form_validation->run();
    }

    public function setValidationRules() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
    }

    function check_database($password) {
       $username = $this->input->post('username');
       $result = $this->user->login($username, $password);
       if($result) {
           $sess_array = array();
           foreach($result as $row) {
               $sess_array = array(
                   'id' => $row->user_cd,
                   'username' => $row->user_nm,
                   'permission' => $row->user_perm_cd,
                   'email' => $row->user_email,
               );
               $this->session->set_userdata('logged_in', $sess_array);
           }
           return true;
       }
       else {
           $this->form_validation->set_message('check_database', 'Invalid username or password');
           return false;
       }
    }
}
