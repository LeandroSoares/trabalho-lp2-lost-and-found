<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends LFController {
    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel','user');
        $this->load->library('form_validation');
    }

    function index() {
        $this->setValidationRules();
        if(empty($this->input->post())){
            $this->dataAdd('form_model', $this->user->signinFormModel());
        }
        else {
            $errorCode = $this->validateForm();
            if($errorCode>0){
                $this->dataAdd('signinerror', true);
                if($errorCode==2){
                    $this->dataAdd('customerror', 'Usuário já existe');
                }else if($errorCode==3){
                    $this->dataAdd('customerror', 'Email já existe');
                }
                $this->dataAdd('form_model', $this->user->signinFormModel());
            }
            else {
                $username= $this->input->post('username');
                $password= $this->input->post('password');
                $email= $this->input->post('email');
                $firstname= $this->input->post('firstname');
                $success = $this->user->signin($username, $password ,$email ,$firstname);
                redirect(base_url(), 'refresh');
            }
        }
        parent::index();
        $this->load->view('signin');
        $this->loadFooter();
    }


    /**
     * validateForm - Valida o formulário de signin usando o form_validation,
     * e verifica se já existe algum valor igual já registrado no banco de dados
     *
     * @return {int} errorCode:[validado ok, erro de formulario, usuário duplicado,email duplicado]
     */
    public function validateForm() {
        if(!$this->form_validation->run()){
            return 1;
        }

        $username= $this->input->post('username');
        if($this->user->checkIfUserExists($username)){
            return 2;
        }

        $email= $this->input->post('email');
        if($this->user->checkIfEmailExists($email)){
            return 3;
        }

        return 0;
    }

    public function setValidationRules() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    }
}
