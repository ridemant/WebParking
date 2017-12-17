<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estacionamientos extends CI_Controller {

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
		$this->load->model('Estacionamientos_model');
	}

	function index(){
		$this->session->verificarSesion();
		$this->panel('estacionamientos');
	}

	public function panel($modulo = null, $accion = null, $id = null){
		$this->session->verificarSesion();
		try{
			if($_SERVER['REQUEST_METHOD'] == 'POST'){

				$var = array(
					"sucursal" 	=>	trim($this->input->post("sucursal")),
					"numero" 	=>	trim($this->input->post("txt_numero")),
					"piso" 		=>	trim($this->input->post("txt_piso")),
				);
				$this->Estacionamientos_model->validar_estacionamiento($var, 1);
				//$this->res = $this->Estacionamientos_model->getRes();
				$this->error = $this->Estacionamientos_model->error;
				$this->msj = $this->Estacionamientos_model->msj;
			}	

			if($accion != null){
				if( $accion == "nuevo"){
					$this->accion['accion'] = "nuevo";
				}
				if( $accion == "editar" ){

					$this->var = $this->Estacionamientos_model->ObtenerEstacionamiento($id);
					$this->accion['accion'] = "editar";
					$this->accion['id'] = $id;
				}
			}
			
			$titulo = 'Lista de Estacionamientos';
			$vista = DIR_PLANTILLA.'tab_estacionamientos';
			$params = array("vista" => $vista, "mod" => 'estacionamientos', "titulo" => $titulo, 'datos' => $this->Estacionamientos_model->listar(),  'datos_sucursal' => $this->Estacionamientos_model, 'accion' => ($accion != null) ? $this->accion : null );

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}
		$this->interfaz->contenedorAdmin($params);
	}

	public function ModificarEstacionamiento($a = null){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$var = array(
				"id"		=> $a,
				"sucursal" 	=>	trim($this->input->post("sucursal")),
				"numero" 	=>	trim($this->input->post("txt_numero")),
				"piso" 		=>	trim($this->input->post("txt_piso"))
			);
			$this->Estacionamientos_model->validar_estacionamiento($var,2);
			$this->res = $this->Estacionamientos_model->getRes();
		}

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".BASE_URL."estacionamientos/"); exit;
	}

	public function EliminarEstacionamiento($a = null){
		
		$this->Estacionamientos_model->EliminarEstacionamiento($a);

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".$_SERVER['HTTP_REFERER']); exit;

	}


	
}

?>