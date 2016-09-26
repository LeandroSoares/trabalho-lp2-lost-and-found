<?php

class UserModel extends CI_Model{
    function UserModel() {
        parent::__construct();
        // $this->load->model('dao/LoginDAO', 'dao');
    }

    public function login($username, $password) {
        $this -> db -> select('user_cd, user_nm, user_ps, user_perm_cd');
        $this -> db -> from('user');
        $this -> db -> where('user_nm', $username);
        $this -> db -> where('user_ps', MD5($password));
        $this -> db -> limit(1);

        $query = $this -> db -> get();

        if($query -> num_rows() == 1) {
            return $query->result();
        }
        else {
            return false;
        }
    }

    public function signinFormModel() {
        $signin_form_model = array();
        $signin_form_model['username'] = array( 'type'  => 'text', 'name'  => 'username', 'placeholder' => 'username' );
        $signin_form_model['password'] = array( 'type'  => 'password', 'name'  => 'password' );
        $signin_form_model['email'] = array( 'type'  => 'email', 'name'  => 'email' );
        $signin_form_model['firstname'] = array( 'type'  => 'text', 'name'  => 'firstname' );
        $signin_form_model['lastname'] = array( 'type'  => 'text', 'name'  => 'lastname' );
        $signin_form_model['phone'] = array( 'type'  => 'text', 'name'  => 'phone' );
        return $signin_form_model;
    }

    public function signin($username, $password, $email, $firstname, $lastname='', $phone='') {
        $user=array();
        $user['user_nm'] = $this->db->escape($username);
        $user['user_ps'] = MD5($this->db->escape($password));
        $this->db->insert('user', $user);

        $userdata = $this->login($username, $password);
        if($userdata==false) {
            return false;
        }

        $profile=array();

        $profile['uspr_user_cd'] = $this->db->escape($userdata['user_cd']);
        $profile['uspr_email'] = $this->db->escape($email);
        $profile['uspr_fnm'] = $this->db->escape($firstname);
        $profile['uspr_lnm'] = $this->db->escape($lastname);
        $profile['uspr_phone'] = $this->db->escape($phone);

        return $this->db->insert('user_profile', $profile);
    }
}
