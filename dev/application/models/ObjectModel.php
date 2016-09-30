<?php

class ObjectModel extends CI_Model{
    function ObjectModel() {
        parent::__construct();
        $this->load->library('datamodel/ObjectDataModel');
    }

    public function findByCode($code) {
        $sql = "select * from object where obje_cd=$code";
        $query = $this->db->query($sql);
        $result=array();
        $statusList = $this->getStatusList();
        foreach ($query->result_array() as $value) {
            $obj = new ObjectDataModel($value);
            $obj->setStatus($statusList[$obj->getStatuscode()]);
            array_push($result, $obj);
        }
        return $result[0];
    }


    /**
     * listObjects - retorna um array de objetos tipo ObjectDataModel
     *
     * @return {array} Array<ObjectDataModel>
     */
    public function listObjects() {
        $sql = "select * from object";
        $query = $this->db->query($sql);

        $result=array();
        $statusList = $this->getStatusList();
        foreach ($query->result_array() as $value) {
            $obj = new ObjectDataModel($value);
            $obj->setStatus($statusList[$obj->getStatuscode()]);
            array_push($result, $obj);
        }

        return $result;
    }
    protected function getStatusList() {
        $sql = "select * from object_status";
        $query = $this->db->query($sql);
        $result=array();
        foreach ($query->result_array() as $status) {
            $result[$status['obst_cd']]= $status['obst_ds'];
        }
        return $result;
    }
    public function registerObject($data) {

        $objectModel = new ObjectDataModel();
        $objectModel->setName($data['name']);
        $objectModel->setDescription($data['description']);
        $objectModel->setImage($data['image']);
        $objectModel->setStatuscode($data['statuscode']);
        $objectModel->setEmail($data['email']);

        return $this->db->insert('object', $objectModel->getDataArray());
    }

    /**
     * registerObjectFormModel - tentativa de deixar no model a estrutura de dados dos formulários
     *
     * @return {type}  retorna a estrutura de dados do formulario de registrar Objeto
     */
    public function registerObjectFormModel() {
        $formModel = array();
        $formModel['Nome'] = array('required'=>true, 'type' => 'text', 'name'  => 'name' );
        $formModel['Descrição'] = array('required'=>true, 'type' => 'text', 'name'  => 'description' );
        $formModel['Email'] = array('required'=>false, 'type' => 'email', 'name'  => 'email' );
        $formModel['Imagem'] = array('required'=>false, 'type' => 'file', 'name'  => 'image' );

        $options=array();

        $options[1]='perdido';
        $options[2]='achado';

        $formModel['Status'] = array( 'required'=>false, 'type'  => 'select', 'name'  => 'statuscode' ,'options'=>$options);
        return $formModel;
    }


}
