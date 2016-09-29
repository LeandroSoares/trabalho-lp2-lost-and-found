<?php

class UserModel extends CI_Model{
    function UserModel() {
        parent::__construct();
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

    public function loginFormModel() {
        $login_form_model = array();
        $login_form_model['username'] = array( 'type'  => 'text', 'name'  => 'username', 'placeholder' => 'username' );
        $login_form_model['password'] = array( 'type'  => 'password', 'name'  => 'password' );
        return $login_form_model;
    }

    public function signinFormModel() {
        $signin_form_model = array();
        $signin_form_model['username'] = array( 'type'  => 'text', 'name'  => 'username', 'placeholder' => 'username' );
        $signin_form_model['password'] = array( 'type'  => 'password', 'name'  => 'password' );
        $signin_form_model['email'] = array( 'type'  => 'email', 'name'  => 'email' );
        $signin_form_model['firstname'] = array( 'type'  => 'text', 'name'  => 'firstname' );
        return $signin_form_model;
    }
    public function checkIfUserExists($username){
        return checkIfExists('user_nm', $username);
    }
    public function checkIfEmailExists($email){
        return checkIfExists('user_mail', $email);
    }
    function checkIfExists($field, $value){
        $sql = "select * from user where $field='$value'";
        $query = $this->db->query($sql);
        if($query -> num_rows() == 1) {
            return true;
        }
        else {
            return false;
        }
    }
    public function signin($username, $password, $email, $firstname) {
        $user=array();
        $user['user_nm'] = $username;
        $user['user_ps'] = MD5($password);
        $user['user_email'] = $password;
        $user['user_fnm'] = $firstname;
        return $this->db->insert('user', $user);
    }
}
