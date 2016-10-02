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
     * listobjects - carrega view de listagem de objetos
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
