<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	private $sesion;
	public $error = array();
	public $msj;
	public $res = array();
	private $accion = array();
	public $var = array();

	//Inicializar con constructor
	function __construct(){
		parent::__construct();
		$this->load->library('Interfaz');
		$this->load->library('Session');
		$this->load->model('Admin_model');
	}

	function index(){
		if($this->session->Logueado()) header("Location: ".BASE_URL."inicio/panel");
		//$this->error = array("usuario" => "true");
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			
			$this->Admin_model->setUsuario($this->input->post("usuario"));
			$this->Admin_model->setClave($this->input->post("clave"));
			$this->Admin_model->procesar();

			$this->error = $this->Admin_model->error;
			$this->msj = $this->Admin_model->msj;
		}

		$this->inicio();
	}

	public function inicio(){
		//	Ventana de acceso
		$this->load->view(DIR_ACCESO.'acceso');
	}

	public function salir(){
		//	Cerrar sesion de login
		$this->session->cerrarSesion();
	}


}

?>