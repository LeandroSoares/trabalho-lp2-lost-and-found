<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Object extends LFController {
    public function __construct() {
        parent::__construct();
        $this->load->model('ObjectModel', 'model');
        $this->load->library('form_validation');
    }
    public function object($objectcode) {
        parent::index();
        $this->load->view('list');
        $this->loadFooter();
    }

    /**
     * listobjects - carrega viw de lsitagem de objetos
     *
     * @return {type}  description
     */
    public function listobjects() {
        $this->load->library('datamodel/ObjectDataModel');
        $this->load->library('maker/VPanel');
        $query="";
        if(!empty($this->input->post())){
            $query = $this->input->post('searchquery');
            $this->dataAdd('searchquery', $this->input->post('searchquery'));
        }
        $this->dataAdd('lista', $this->model->listObjects($query));
        parent::index();
        $this->load->view('list');
        $this->loadFooter();
    }

    /**
     * register - carrega view de registrar objeto
     *
     * @return {type}  description
     */
    public function register() {
        $this->load->library('maker/VPanel');
        $this->load->library('maker/form/VFormSelect');
        $this->load->library('maker/VBootstrapFormGroup');
        $this->lock();

        $this->setValidationRules();
        $this->dataAdd('action', base_url('objectregister'));
        $this->dataAdd('form_model', $this->model->registerObjectFormModel());

        if(!empty($this->input->post())){

            if(!$this->validateForm()) {
                $this->dataAdd('error', true);
            }
            else{
                //inserir no banco
                $img = file_get_contents($_FILES['image']['tmp_name']);
                $data = $this->input->post();
                $data['image'] = $img;

                $success = $this->model->registerObject($data);
                $this->session->set_flashdata("register_status", 1);
                $this->session->set_flashdata("register_message","Objeto adicionado com sucesso!");
                redirect(base_url('objectlist'));
            }
        }

        parent::index();
        $this->load->view('register');
        $this->loadFooter();
    }
    private function emailConfig() {
        $config=array();
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'smtp-mail.outlook.com';
        $config['smtp_user'] = 'faculdade_ifsp@outlook.com';
        $config['smtp_pass'] = 'JQX8vU_YHc';
        $config['smtp_port'] = '587';
        $config['smtp_crypto'] = 'tls';
        $config['smtp_timeout'] = '7';


        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'text';
        $config['validation'] = true;
        $config['wordwrap'] = true;
        $config['mailtype'] = 'html';

        $config['wrapchars'] = 76;
        $config['validate'] = false;
        $config['priority'] = 3;

        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";

        $config['bcc_batch_mode'] = false;
        $config['bcc_batch_size'] = 200;

        return $config;
    }

    private function sendEmail($founder, $loster,$founderEmail, $losterEmail, $objeto) {

        $this->load->library('email');

        $this->email->initialize($this->emailConfig());

        $this->email->from('E117S3V3N@outlook.com', 'Lost&Found');
        $this->email->to($losterEmail);
        $this->email->cc($founderEmail);

        $this->email->subject('Objeto encontrado #'.$objeto->getCode());
        $this->email->message($loster.' o "'.$objeto->getName().'" foi encontrado por: '.$founder);
        return $this->email->send();
    }

    public function found($code, $statuscode) {
        $this->lock();
        $session_data = $this->session->userdata('logged_in');
        $objeto = $this->model->findByCode($code);
        $this->load->model('UserModel', 'usermodel');
        if($statuscode==1) {
            $founderEmail=$session_data['email'];
            $founder=$session_data['username'];
            $losterEmail = $objeto->getEmail();
            $user = $this->usermodel->getUserByEmail($losterEmail);
            $loster=$user['user_nm'];
        }
        else if($statuscode==2){
            $losterEmail = $session_data['email'];
            $loster=$session_data['username'];
            $founderEmail = $objeto->getEmail();
            $user = $this->usermodel->getUserByEmail($losterEmail);
            $founder=$user['user_nm'];
        }

        $mailstatus = $this->sendEmail($founder, $loster,$founderEmail, $losterEmail, $objeto);

        if ($mailstatus) {
            $this->session->set_flashdata("register_status", 1);
            $this->session->set_flashdata("register_message", "Email enviado para o dono com sucesso!");

        } else {
            $this->session->set_flashdata("register_status", 2);
            $this->session->set_flashdata("register_message","Falha no envio de email de notificação...");
            // echo $this->email->print_debugger();
        }
        redirect(base_url('objectlist'));

    }

    private function validateForm() {
        return $this->form_validation->run();
    }
    private function setValidationRules() {
        foreach ($this->model->registerObjectFormModel() as $key => $value) {
            if($value['required']==true){
                $this->form_validation->set_rules($value['name'], $key, 'trim|required|xss_clean');
            }
        }
    }

}
