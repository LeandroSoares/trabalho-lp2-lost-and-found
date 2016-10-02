<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller de signin
 */
class Signin extends LFController {
    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel','user');
        $this->load->library('form_validation');
        $this->load->library(array('maker/vcore/VHx', 'maker/vcore/VDiv', 'maker/VBootstrapFormGroup', 'maker/VPanel'));
    }

    function index() {

        $this->setValidationRules();
        //caso não tenha dados de post, é a primeira vez na página
        if(empty($this->input->post())){
            //passando  estrutura de formulário de signin que está na model
            $this->dataAdd('form_model', $this->user->signinFormModel());
        }
        else {
            //se tem dados de post valide

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

                $success = $this->user->signin($username, $password , $email ,$firstname);
                //caso tudo ok passa mensagem e manda para o login
                $this->session->set_flashdata('signin', 'Usuário <strong>'.$username.'</strong> cadastrado com sucesso!');
                redirect(base_url('login'));
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

    /**
     * setValidationRules - aplica regras de validacao de formulário
     *
     * @return {type}  description
     */
    public function setValidationRules() {
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    }
}
