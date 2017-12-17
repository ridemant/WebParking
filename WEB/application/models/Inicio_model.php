<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio_model extends CI_Model {

	private $usuario;
	private $clave;
	
    // Lista de errores y resultados
	public $error = array();
	private $res = array();
	public $msj;

	function __construct(){
		//$this->db = $this->load->library('DB');
		parent::__construct();
		$this->load->library('Session');
	}


	public function consultarEstado($a = null){
		$estado = "";
		switch($a){
			case 1: 
				$estado = "disponible";
				break;
			case 2: 
				$estado = "reservado";
				break;
			case 3: 
				$estado = "ocupado";
				break;

		}
		return $estado;
	}

	public function listar(){
		$soapClient = new SoapClient(WSDL_RESERVAS); 

		$re = $soapClient->ListaReserva();

		return $re;
	}

	public function ObtenerSucursal($a = null){

		try{
			$soapClient = new SoapClient(WSDL_SUCURSAL); 

			$re = $soapClient->ObtenerSucursal(array("sucursal_id" => $a));

			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}

	}


}

?>