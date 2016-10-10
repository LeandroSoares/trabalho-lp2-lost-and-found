<?php

class UserModel extends CI_Model
{
    public function UserModel()
    {
        parent::__construct();
    }

    /**
     * login - faz loguinnn.
     *
     * @param {String} $username
     * @param {string} $password
     *
     * @return {boolean}
     */
    public function login($username, $password)
    {
        $this->db->select('user_cd, user_nm, user_ps, user_email');
        $this->db->from('user');
        $this->db->where('user_nm', $username);
        $this->db->where('user_ps', md5($password));
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getUserByEmail($email)
    {
        $this->db->select('user_cd, user_nm, user_ps, user_email');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->limit(1);

        $query = $this->db->get();

        if ($query->num_rows() == 1) {
            return $query->result_array()[0];
        } else {
            return false;
        }
    }
    public function loginFormModel()
    {
        $login_form_model = array();
        $login_form_model['username'] = array('type' => 'text', 'name' => 'username', 'placeholder' => 'username');
        $login_form_model['password'] = array('type' => 'password', 'name' => 'password');

        return $login_form_model;
    }

    public function signinFormModel()
    {
        $signin_form_model = array();
        $signin_form_model['username'] = array('required' => true, 'type' => 'text', 'name' => 'username', 'placeholder' => 'username');
        $signin_form_model['password'] = array('required' => true, 'type' => 'password', 'name' => 'password');
        $signin_form_model['email'] = array('required' => true, 'type' => 'email', 'name' => 'email');
        $signin_form_model['firstname'] = array('required' => true, 'type' => 'text', 'name' => 'firstname');

        return $signin_form_model;
    }

    public function checkIfUserExists($username)
    {
        return $this->checkIfExists('user_nm', $username);
    }

    public function checkIfEmailExists($email)
    {
        return $this->checkIfExists('user_email', $email);
    }
    public function checkIfExists($field, $value)
    {
        $sql = "select * from user where $field='$value'";
        $query = $this->db->query($sql);
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }
    public function signin($username, $password, $email, $firstname)
    {
        $user = array();
        $user['user_nm'] = $username;
        $user['user_ps'] = md5($password);
        $user['user_email'] = $email;
        $user['user_fnm'] = $firstname;

        return $this->db->insert('user', $user);
    }
}
