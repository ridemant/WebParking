<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas extends CI_Controller {

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
		$this->load->model('Reservas_model');
	}

	function index(){
		$this->session->verificarSesion();
		$this->panel('reservas');
	}

	public function panel($modulo = null, $accion = null, $id = null){
		$this->session->verificarSesion();
		try{
			if($accion != null){
				if( $accion == "editar" ){
					$this->var = $this->Reservas_model->ObtenerReserva($id);
					$this->accion['accion'] = "editar";
					$this->accion['id'] = $id;
				}
			}
			
			$titulo = 'Lista de Reservas';
			$vista = DIR_PLANTILLA.'tab_reservas';
			$params = array("vista" => $vista, "mod" => 'reservas', "titulo" => $titulo, 'datos' => $this->Reservas_model->listar(),  'datos_reservas' => $this->Reservas_model, 'accion' => ($accion != null) ? $this->accion : null );

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}
		$this->interfaz->contenedorAdmin($params);
	}

	public function ModificarReserva($a = null){
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			$var = array(
				"id"				=> $a,
				"estacionamiento"	=>	trim($this->input->post("estacionamiento")),
				"fecha"				=>	trim($this->input->post("txt_fecha")),
				"estado"				=>	trim($this->input->post("txt_estado")),
			);
			$this->Reservas_model->validar_reserva($var);
			$this->res = $this->Reservas_model->getRes();
		}

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".BASE_URL."reservas/"); exit;
	}

	public function EliminarUsuario($a = null){
		
		$this->Reservas_model->EliminarUsuario($a);

		if(isset($_SERVER['HTTP_REFERER']))	header("Location: ".$_SERVER['HTTP_REFERER']); exit;

	}

	

	public function actualizar(){
		$li = "";
		$datos = $this->Reservas_model->listar();
		for ($i=0; $i < count($datos->ListaReservaResult->Reserva); $i++) { 

			$li .= '<li class="lista-reservas">
		                <div>'.$datos->ListaReservaResult->Reserva[$i]->id.'</div>
		                <div>'.$datos->ListaReservaResult->Reserva[$i]->estacionamiento_id.'</div>
		                <div>'.$datos->ListaReservaResult->Reserva[$i]->fecha.'</div>
		                <div>'.$this->Reservas_model->consultarEstado($datos->ListaReservaResult->Reserva[$i]->estado).'</div>
		                <div class="text-right">
		                  <a class="btn btn-primary btn-xs" href="'.BASE_URL.'reservas/panel/reservas/editar/'.$datos->ListaReservaResult->Reserva[$i]->id.'">
		                    <span class="glyphicon glyphicon-edit"></span> 
		                    Editar
		                  </a>
		                </div>
		              </li>'; 

		}
		
		$arreglo = array(
			"nombre" => $li

		);

		echo json_encode($arreglo);	}

	
}

?>