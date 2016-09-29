<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Object extends LFController {
    public function __construct() {
        parent::__construct();
        $this->load->model('ObjectModel', 'model');
        $this->load->library('form_validation');
    }
    public function object($objectcode) {
        parent::index();
        // echo $objectcode;
    }

    public function register() {
        $this->setValidationRules();
        $this->dataAdd('action', base_url('objectregister'));
        $this->dataAdd('form_model', $this->model->registerObjectFormModel());

        if(!empty($this->input->post())){

            if(!$this->validateForm()) {
                $this->dataAdd('error', true);
            }
            else{
                //inserir no banco
                $success = $this->model->registerObject($this->input->post());

                $this->dataAdd('success', 'Objeto adicionado com sucesso!');
            }
        }

        parent::index();
        $this->load->view('register');
        $this->loadFooter();
    }
    public function validateForm() {
        return $this->form_validation->run();
    }
    public function setValidationRules() {
        foreach ($this->model->registerObjectFormModel() as $key => $value) {
            if($value['required']==true){
                $this->form_validation->set_rules($value['name'], $key, 'trim|required|xss_clean');
            }
        }
    }
    public function registerSave() {

    }

    public function listobjects() {
        parent::index();
        $this->load->view('register');
        $this->loadFooter();
    }
}
