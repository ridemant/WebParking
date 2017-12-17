<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales extends CI_Controller {

	private $sesion;
	public $error;
	public $msj;
	public $res;
	private $accion = array();
	public $var = array();

	//Inicializar con constructor
	function __construct(){
		parent::__construct();
		$this->load->library('Interfaz');
		$this->load->library('Session');
		$this->load->model('Sucursales_model');
	}

	function index(){
		$this->session->verificarSesion();
		$this->panel("sucursales");
	}

	public function panel($modulo = null, $accion = null, $id = null){
		$this->session->verificarSesion();
		try{
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$var = array(
					"sucursal" 	=>	trim($this->input->post("txt_sucursal")),
					"tarifa" 	=>	trim($this->input->post("txt_tarifa"))
				);
				$this->Sucursales_model->validar_sucursal($var, 1);
				//$this->res = $this->Sucursales_model->getRes();
				$this->error = $this->Sucursales_model->error;
				$this->msj = $this->Sucursales_model->msj;
			}

			if($accion != null){
				if( $accion == "nuevo"){
					$this->accion['accion'] = "nuevo";
				}
				if( $accion == "editar" ){

					$this->var = $this->Sucursales_model->ObtenerSucursal($id);
					$this->accion['accion'] = "editar";
					$this->accion['id'] = $id;
				}
			}
			
			$titulo = 'Lista de sucursales';
			$vista = DIR_PLANTILLA.'tab_sucursales';
			$params = array("vista" => $vista, "mod" => 'sucursales', "titulo" => $titulo, 'datos' => $this->Sucursales_model->listar(), 'accion' => ($accion != null) ? $this->accion : null );

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}
		$this->interfaz->contenedorAdmin($params);
	}

	public function ModificarSucursal($a = null){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$var = array(
				"id"		=> $a,
				"sucursal" 	=>	trim($this->input->post("txt_sucursal")),
				"tarifa" 	=>	trim($this->input->post("txt_tarifa"))
			);
			$this->Sucursales_model->validar_sucursal($var,2);
			$this->res = $this->Sucursales_model->getRes();
		}

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".BASE_URL."sucursales/"); exit;
	}

	public function EliminarSucursal($a = null){
		
		$this->Sucursales_model->EliminarSucursal($a);

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".$_SERVER['HTTP_REFERER']); exit;

	}


	
}

?>