<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SendMail extends LFController {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel', 'user');
        $this->load->library('form_validation');
        $this->load->library(array('maker/VPanel','maker/vcore/VDiv'));
    }

    /**
     * object - funcao q recebe os valores pe url de qual objeto esta sendo tratado e qual seu status
     *
     * @param  {int} $code=""
     * @param  {int} $statuscode=""
     * @return {void}
     */
    public function object($code="", $statuscode="") {
        $this->lock();
        // so tratamos os dados depois que o usuários confirma na tela
        // e recebemos um post
        if(!empty($this->input->post())) {
            $this->getFormData($code,$statuscode);
        }
        parent::index();
        $this->load->view('sendmail');
        $this->loadFooter();
    }

    /**
     * getFormData - trada os dados recebidos pela url e manda de volta para a lista de objetos
     *
     * @param  {int} $code
     * @param  {int} $statuscode
     * @return {void}
     */
    public function getFormData($code, $statuscode) {

        $message = $this->input->post('message');

        $this->load->model('UserModel', 'usermodel');
        $this->load->model('ObjectModel', 'objectmodel');

        $session_data = $this->session->userdata('logged_in');
        $objeto = $this->objectmodel->findByCode($code);

        //se for 1 é objeto perdido que foi encontrado pelo usuário
        if($statuscode==1) {
            $founderEmail=$session_data['email'];
            $founder=$session_data['username'];
            $losterEmail = $objeto->getEmail();
            $user = $this->usermodel->getUserByEmail($losterEmail);
            $loster=$user['user_nm'];
        }
        //se for 2 é objeto encontrado que foi perdido pelo usuário
        else if($statuscode==2){
            $losterEmail = $session_data['email'];
            $loster=$session_data['username'];
            $founderEmail = $objeto->getEmail();
            $user = $this->usermodel->getUserByEmail($losterEmail);
            $founder=$user['user_nm'];
        }

        $mailstatus = $this->sendEmail($founder, $loster, $founderEmail, $losterEmail, $objeto, $message);

        if ($mailstatus) {
            $this->session->set_flashdata("register_status", 1);
            $this->session->set_flashdata("register_message", "Email enviado para o dono com sucesso!");
            $this->objectmodel->setStatusFound($code);

        } else {
            $this->session->set_flashdata("register_status", 2);
            $this->session->set_flashdata("register_message","Falha no envio de email de notificação...");
            echo $this->email->print_debugger();
        }
        redirect(base_url('objectlist'));
    }

    /**
     * emailConfig - configurando dados de servidor de email
     *
     * @return {type}  description
     */
    private function emailConfig() {
        $config=array();
        // tentando outlook
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'smtp-mail.outlook.com';
        // $config['smtp_user'] = 'E117S3V3N@outlook.com';
        // $config['smtp_pass'] = 'qw12QW!@';
        // $config['smtp_port'] = '587';
        // $config['smtp_crypto'] = 'tls';
        // $config['smtp_timeout'] = '7';
        // gmail
        // $config['protocol'] = 'smtp';
        // $config['smtp_host'] = 'smtp-mail.outlook.com';
        // $config['smtp_user'] = 'E117S3V3N@gmail.com';
        // $config['smtp_pass'] = 'qw12QW!@';
        // $config['smtp_port'] = '465';
        // $config['smtp_crypto'] = 'ssl';
        // $config['smtp_timeout'] = '7';

        //servidor próprio
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'nuvem18.hoteldaweb.com.br';
        $config['smtp_user'] = 'lostandfound@leandrogamedesigner.com.br';
        $config['smtp_pass'] = 'qwe123';
        $config['smtp_port'] = '465';
        $config['smtp_crypto'] = 'ssl';
        $config['smtp_timeout'] = '7';

        //config geral
        $config['charset'] = 'utf-8';
        $config['mailtype'] = 'text';
        $config['validation'] = true;
        $config['wordwrap'] = true;
        $config['mailtype'] = 'html';

        $config['wrapchars'] = 76;
        $config['validate'] = false;
        $config['priority'] = 3;

        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";

        $config['bcc_batch_mode'] = false;
        $config['bcc_batch_size'] = 200;

        return $config;
    }

    /**
     * sendEmail - envia o email de aviso para os usuários envolvidos
     *
     * @param  {string}          $founder      usuário que achou
     * @param  {string}          $loster       usuário que perdeu
     * @param  {string}          $founderEmail email do usuário que achou
     * @param  {string}          $losterEmail  email do usuário que perdeu
     * @param  {ObjectDataModel} $objeto       objeto
     * @param  {string}          $message      mensagem do usuário
     * @return {boolen}          retorna se mandou omail com sucesso
     */
    private function sendEmail($founder, $loster,$founderEmail, $losterEmail, $objeto, $message) {

        $this->load->library('email');

        $this->email->initialize($this->emailConfig());

        $this->email->from('E117S3V3N@outlook.com', 'Lost&Found');
        $this->email->to($losterEmail);
        $this->email->cc($founderEmail);

        $this->email->subject('Objeto encontrado #'.$objeto->getCode()."-".$objeto->getName());
        $this->email->message("Aviso do sistema<br>".$loster.' o "'.$objeto->getName().'" foi encontrado por: '.$founder.'<br><br>'.$message);
        return $this->email->send();
    }


}
