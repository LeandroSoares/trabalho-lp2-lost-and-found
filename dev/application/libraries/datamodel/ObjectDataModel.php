<?php

/**
 * ObjectDataModel
 *
 * Classe para tratar linhas da tabela de objeto
 */
class ObjectDataModel
{
    private $data_array;
    private $status;
    function __construct($data_array=array()) {
        $this->data_array=$data_array;
        $this->status="";
    }

    public function getCode() {
        return $this->data_array['obje_cd'];
    }
    public function getName() {
        return $this->data_array['obje_nm'];
    }
    public function setName($value) {
         $this->data_array['obje_nm']=$value;
     }
    public function getDescription() {
        return $this->data_array['obje_ds'];
    }
    public function setDescription($value) {
         $this->data_array['obje_ds']=$value;
     }
    public function getImage() {
        return $this->data_array['obje_img'];
    }
    public function setImage($value) {
         $this->data_array['obje_img']=$value;
     }
    public function getStatuscode() {
        return $this->data_array['obje_obst_cd'];
    }
    public function setStatuscode($value) {
         $this->data_array['obje_obst_cd']=$value;
    }
    public function getStatus() {
        return $this->status;
    }
    public function setStatus($value) {
         $this->status=$value;
    }
    public function getEmail() {
        return $this->data_array['obje_email'];
    }
    public function setEmail($value) {
         $this->data_array['obje_email']=$value;
    }

    public function getDataArray() {
        return $this->data_array;
    }
}
