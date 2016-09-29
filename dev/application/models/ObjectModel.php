<?php

class ObjectModel extends CI_Model{
    function ObjectModel() {
        parent::__construct();
    }

    public function findByCode($code) {
        $sql = "select * from object where obje_cd=$code";
        $query = $this->db->query($sql);
    }
    public function registerObject($data) {

        $querydata=array();
        $querydata['obje_nm'] =$data['name'];
        $querydata['obje_ds'] =$data['description'];
        $querydata['obje_img'] =$data['image'];
        $querydata['obje_obst_cd'] =$data['statuscode'];
        $querydata['obje_email'] =$data['email'];
        return $this->db->insert('object', $querydata);
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
