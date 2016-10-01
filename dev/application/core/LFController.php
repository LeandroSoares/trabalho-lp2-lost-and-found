<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * class LFController
 */
class LFController extends CI_Controller {

    /**
     * @var {array} $data - variável para armazenar todos os dados a serem passados
     *      para a view.
     */
    private $data=array();

    /**
     * __construct - Já carrega as bibliotecas necessárias.
     *
     * @return {void}
     */
    public function __construct() {
        parent::__construct();
        $this->load->helper ( 'form' );
        $this->load->helper ( 'url' );
        $this->load->helper ( 'security' );
        $this->load->helper ( 'language' );
        $this->load->library('form_validation');
    }

    /**
     * dataAdd - metodo para adicionar dados a serem passados para as views
     *
     * @param  {String} $key nome da variavel para a view poder receber o dado
     * @param           $val valor do dado a ser passado
     * @return {void}
     */
    protected function dataAdd($key, $val) {
        $this->data[$key]=$val;
    }

    /**
     * clearData - limpa os dados a serem passados para a voew
     *
     * @return {void}
     */
    protected function clearData() {
        $this->data=array();
    }
    private $locked;
    protected function lock() {
        $this->locked=true;
    }
    /**
     * index - customizacao da index para já checar se o usuário está logado
     *         assim redirancionando caso entre em telas que só podem ser
     *         acessadas quando logadas.
     *         Também adiciona o header.
     *
     * @return {void}
     */
    public function index() {
        $logged=false;
        if($this->session->userdata('logged_in')){
            $session_data = $this->session->userdata('logged_in');
            $this->dataAdd('username', $session_data['username']);
            $logged=true;
        }

        $this->dataAdd('login', $logged);
        if(isset($this->locked)){
            if($this->locked && $logged==false) {
                $this->session->set_flashdata('lock', uri_string());
                redirect(base_url('login'), 'refresh');
            }
        }
        $this->load->view('common/header', $this->data);
    }

    /**
     * loadFooter - metodo para carregar o footer padrao deste projeto
     *
     * @param  {array} $params(opcional) parametros a serem passados para a view de footer
     * @return {void}
     */
    function loadFooter($params='') {
        $this->load->view('common/footer', $params);
    }

    /**
     * logout - Padrão para deslogar
     *
     * @return {void}
     */
    function logout() {
       $this->session->unset_userdata('logged_in');
       session_destroy();
       redirect(base_url(), 'refresh');
       $this->clearData();
    }
}
