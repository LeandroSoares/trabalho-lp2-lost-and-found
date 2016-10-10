<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller de Login
 */
class Login extends LFController {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel', 'user');
        $this->load->library('form_validation');
        $this->load->library(array('maker/VPanel','maker/vcore/VDiv'));
    }

    function index() {
        $this->setValidationRules();
        if(!$this->validateForm()) {
            if(!empty($this->input->post()))
                $this->dataAdd('loginerror', true);
        }
        else if(!empty($this->input->post())){
            $url = $this->session->flashdata('lock');
            redirect(base_url($url), 'refresh');
        }
        // salvando ultima página travada acessada para voltar a ela
        // caso o usuário acessou uma pagina que requer que esteja logado
        $url = $this->session->flashdata('lock');
        $this->session->set_flashdata('lock', $url);

        parent::index();
        $this->load->view('login');
        $this->loadFooter();
    }

    public function validateForm() {
        return $this->form_validation->run();
    }

    public function setValidationRules() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');
    }

    /**
     * check_database - verifica se o usuário é valido
     *
     * @param  {type} $password description
     * @return {type}           description
     */
    function check_database($password) {
       $username = $this->input->post('username');
       $result = $this->user->login($username, $password);
       if($result) {
           $sess_array = array();
           foreach($result as $row) {
               $sess_array = array(
                   'id' => $row->user_cd,
                   'username' => $row->user_nm,
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
