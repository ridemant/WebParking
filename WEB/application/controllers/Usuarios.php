<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	private $sesion;
	public $error;
	public $msj;
	public $res = array();
	private $accion = array();
	public $var = array();

	//Inicializar con constructor
	function __construct(){
		parent::__construct();
		$this->load->library('Interfaz');
		$this->load->library('Session');
		$this->load->model('Usuarios_model');
	}

	function index(){
		$this->session->verificarSesion();
		$this->panel('usuarios');
	}

	public function panel($modulo = null, $accion = null, $id = null){
		$this->session->verificarSesion();
		try{
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				$var = array(
					"nombres" 		=>	trim($this->input->post("txt_nombres")),
					"appaterno" 	=>	trim($this->input->post("txt_appaterno")),
					"apmaterno" 	=>	trim($this->input->post("txt_apmaterno")),
					"correo"		=>	trim($this->input->post("txt_correo")),
					"usuario" 		=>	trim($this->input->post("txt_usuario")),
					"clave" 		=>	trim($this->input->post("txt_clave")),
					"dni" 			=>	trim($this->input->post("txt_dni")),
					"tipo" 			=>	trim($this->input->post("tipo")),
					"saldo" 		=>	trim($this->input->post("txt_saldo")),
				);
				$this->Usuarios_model->validar_usuario($var, 1);
				//$this->res = $this->Usuarios_model->getRes();
				$this->error = $this->Usuarios_model->error;
				$this->msj = $this->Usuarios_model->msj;
			}	

			if($accion != null){
				if( $accion == "nuevo"){
					$this->accion['accion'] = "nuevo";
				}
				if( $accion == "editar" ){
					$this->var = $this->Usuarios_model->ObtenerUsuario($id);
					$this->accion['accion'] = "editar";
					$this->accion['id'] = $id;
				}
			}
			
			$titulo = 'Lista de Usuarios';
			$vista = DIR_PLANTILLA.'tab_usuarios';
			$params = array("vista" => $vista, "mod" => 'usuarios', "titulo" => $titulo, 'datos' => $this->Usuarios_model->listar(),  'datos_sucursal' => $this->Usuarios_model, 'accion' => ($accion != null) ? $this->accion : null );

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}
		$this->interfaz->contenedorAdmin($params);
	}

	public function ModificarUsuario($a = null){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$var = array(
				"id"			=> $a,
				"nombres" 		=>	trim($this->input->post("txt_nombres")),
				"appaterno" 	=>	trim($this->input->post("txt_appaterno")),
				"apmaterno" 	=>	trim($this->input->post("txt_apmaterno")),
				"correo"		=>	trim($this->input->post("txt_correo")),
				"usuario" 		=>	trim($this->input->post("txt_usuario")),
				"clave" 		=>	trim($this->input->post("txt_clave")),
				"dni" 			=>	trim($this->input->post("txt_dni")),
				"tipo" 			=>	trim($this->input->post("tipo")),
				"saldo" 		=>	trim($this->input->post("txt_saldo")),
			);
			$this->Usuarios_model->validar_usuario($var,2);
			$this->res = $this->Usuarios_model->getRes();
		}

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".BASE_URL."usuarios/"); exit;
	}

	public function EliminarUsuario($a = null){
		
		$this->Usuarios_model->EliminarUsuario($a);

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".$_SERVER['HTTP_REFERER']); exit;

	}


	
}

?>