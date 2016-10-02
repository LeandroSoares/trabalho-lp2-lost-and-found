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
    public function setStatusFound($code) {
        $sql="UPDATE object SET obje_obst_cd=3 WHERE obje_cd=$code";
        $query = $this->db->query($sql);
        return $query;
    }
    /**
     * listObjects - retorna um array de objetos tipo ObjectDataModel
     *
     * @return {array} Array<ObjectDataModel>
     */
    public function listObjects($seachQuery="") {
        $sql = "select * from object order by obje_obst_cd,obje_cd DESC";
        if($seachQuery){
            $sql = 'Select * from (select * from object, object_status where object.obje_obst_cd=object_status.obst_cd) as obj where Concat(obj.obje_nm, "", obj.obje_ds,"",obj.obst_ds) like "%'.$seachQuery.'%"';
            if(intval($seachQuery)>0)
                $sql = 'Select * from object where obje_cd='.intval($seachQuery);
        }
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

    /**
     * getStatusList - retorna lista de status
     *
     * @return {type}  description
     */
    protected function getStatusList() {
        $sql = "select * from object_status";
        $query = $this->db->query($sql);
        $result=array();
        foreach ($query->result_array() as $status) {
            $result[$status['obst_cd']]= $status['obst_ds'];
        }
        return $result;
    }

    /**
     * registerObject - registra objeto na base de dados
     *
     * @param  {type} $data description
     * @return {type}       description
     */
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
                $options[""]='';
                $options[1] = 'perdido';
                $options[2] = 'achado';

                 $formModel = array();
         $formModel['Nome'] = array('required'=>true , 'type' => 'text'  , 'name'  => 'name'        );
    $formModel['Descrição'] = array('required'=>true , 'type' => 'text'  , 'name'  => 'description' );
        $formModel['Email'] = array('required'=>true , 'type' => 'email' , 'name'  => 'email'       );
       $formModel['Imagem'] = array(                 'type' => 'file'  , 'name'  => 'image'       );
       $formModel['Status'] = array('required'=>true , 'type' => 'select', 'name'  => 'statuscode'
                                    , 'options' =>$options );
        return $formModel;
    }


}
