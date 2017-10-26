<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Model_usuarios');
	}
	public function index(){
		if( $this->session->userdata('id') ){

			$data['title'] = '<h1> Bienvenido <small>Sistema de gestión</small> </h1>';
			$data['migajas'] = '<li class="active" ><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>';

			$data['contenido'] = 'home/app';
			$this->load->view('template-home', $data);
		}else{
			redirect('login');
		}
	}
	public function backup(){
		if( $this->session->userdata('id') ){

			$data['title'] = '<h1> Bienvenido <small>Sistema de gestión</small> </h1>';
			$data['migajas'] = '<li class="active" ><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>';

			$data['contenido'] = 'home/backup';
			$this->load->view('template-home', $data);
		}else{
			redirect('login');
		}	
	}
   	/*Alerta Desarrollo*/
   	/*
    public function alert_visto(){
    	$name = $this->session->userdata('nombre');
    	$tiempo = date('d/m/Y H:i:s');

		$config['protocol'] = 'mail';
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n";
		$this->email->initialize($config);
		$this->email->from('contacto@infoplan.cl', 'app forestal');
		$this->email->to('aaguayonitrigual@gmail.com');
		$this->email->subject('Inicio sesion');
   
        $this->email->message($name.' ha iniciado sesion<br> Ingreso: '.$tiempo.'<br>');

        $this->email->send();

    }	
    */	
}
