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
        $this->load->library('maker/VObjectPanel');
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

        // $config['charset'] = 'iso-8859-1';
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'text';
        $config['validation'] = true;
        $config['wordwrap'] = true;
        $config['wrapchars'] = 76;
        $config['mailtype'] = 'html';
        $config['validate'] = false;
        $config['priority'] = 3;

        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";

        $config['bcc_batch_mode'] = false;
        $config['bcc_batch_size'] = 200;

        return $config;
    }

    private function sendEmail($founder, $loster, $objetoNome) {

        $this->load->library('email');

        $this->email->initialize($this->emailConfig());

        $this->email->from('faculdade_ifsp@outlook.com', 'Lost&Found');
        $this->email->to($loster);
        $this->email->cc($founder);

        $this->email->subject('Objeto encontrado #');
        $this->email->message($loster.' o "'.$objeto.'" foi encontrado por: '.$founder);
        return $this->email->send();
    }

    public function found($code, $statuscode) {
        $this->lock();
        $session_data = $this->session->userdata('logged_in');
        $objeto = $this->model->findByCode($code);

        // if($statuscode==1) {
            $founder=$session_data['email'];
            $loster = $objeto->getEmail();
            $objetoNome = $objeto->getName();
        // }

        $mailstatus = $this->sendEmail($founder, $loster, $objetoNome);
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
