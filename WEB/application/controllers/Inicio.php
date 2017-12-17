<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller {

	private $sesion;
	public $error;
	public $msj;
	public $res = array();
	private $accion = array();

	//Inicializar con constructor
	function __construct(){
		parent::__construct();
		$this->load->library('Interfaz');
		$this->load->library('Session');
		$this->load->model('Inicio_model');
		$this->load->model('Reservas_model');
	}

	function index(){
		$this->session->verificarSesion();
		$this->panel('home');
	}

	public function panel($modulo = null, $accion = null, $id = null){
		$this->session->verificarSesion();
		try{
			
			$titulo = 'Estado de estacionamiento';
			$vista = DIR_PLANTILLA.'tab_inicio';
			$params = array("vista" => $vista, "mod" => 'home', "titulo" => $titulo, 'datos' => $this->Inicio_model->listar(),  'datos_inicio' => $this->Inicio_model);

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}
		$this->interfaz->contenedorAdmin($params);
	}

	public function actualizar(){
		$li = "";
		$datos = $this->Reservas_model->listar();
		for ($i=0; $i < count($datos->ListaReservaResult->Reserva); $i++) { 
		    $li .= '<li>
			          <a class="'.$this->Reservas_model->consultarEstado($datos->ListaReservaResult->Reserva[$i]->estado).'">
			            <div>'.$this->Reservas_model->consultarEstado($datos->ListaReservaResult->Reserva[$i]->estado).'</div>
			            <div>'.$datos->ListaReservaResult->Reserva[$i]->id.'</div> 
			          </a>
			        </li>';

		}
		
		$arreglo = array(
			"estado" => $li

		);

		echo json_encode($arreglo);	
	}


}

?>