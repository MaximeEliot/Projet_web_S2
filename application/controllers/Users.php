<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 


class Users extends CI_Controller {

	public function __construct(){
		parent::__construct();
        $this->load->model('model_inscription');
        $this->load->model('Model_login');


	}

    public function create_user(){
        $log_ins = filter_input(INPUT_POST,"login_Ins",FILTER_DEFAULT,['options' => ['default' => null]]);
        $psswd_ins=filter_input(INPUT_POST,"passwd_Ins",FILTER_DEFAULT,['options' => ['default' => '']]);
        $pseudo = filter_input(INPUT_POST,"pseudo",FILTER_DEFAULT,['options' => ['default' => null]]);
        if($log_ins!=null && $psswd_ins!='' && $pseudo!= null){
            $psswd_ins = password_hash($psswd_ins,PASSWORD_DEFAULT);
            $result = $this->model_inscription->inscript($log_ins,$psswd_ins,$pseudo);
            if($result){
                header('Location: ../index.php/login');
                exit;
            }
        }
    $this->load->view('layout/header_series');    
    $this->load->view('vue_Inscription');
    }
    
    public function login(){

        $log= filter_input(INPUT_POST,"login",FILTER_DEFAULT,['options' => ['default' => null]]);
        $psswd=filter_input(INPUT_POST,"passwd",FILTER_DEFAULT, ['options' => ['default' => null]]);

        if($log!=null && $psswd!=null ){

            $verif= $this->Model_login->getPassword($log);
            if($verif!=null){
            $verif = password_verify($psswd, $verif);}


            if($verif){
                session_start();
                $_SESSION['login']=1;
                $_SESSION['pseudo']=$this->Model_login->getPseudo($log);
                header('Location: ../');
                exit;
            }
        
        }
        $this->load->view('layout/header_series');
        $this->load->view('vue_Login');


    }

	public function disconnect() {
        session_start();  
        session_destroy();
        setcookie('PHPSESSID','',0);
        header("Location: ".site_url("/")) ;
        exit();
    }
}
