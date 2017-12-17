<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reservas_model extends CI_Model {

	private $usuario;
	private $clave;

    // Lista de errores y resultados
	public $error;
	private $res = array();
	public $msj;

	function __construct(){
		//$this->db = $this->load->library('DB');
		parent::__construct();
		$this->load->library('Session');
	}
	
	public function getRes(){ return $this->res; }



	///////////////////////////////////////////////////////////////////////////

	public function listar(){
		$soapClient = new SoapClient(WSDL_RESERVAS); 

		$re = $soapClient->ListaReserva();

		return $re;
	}

	public function listar_estacionamiento($a = null){
		$soapClient = new SoapClient(WSDL_ESTACIONAMIENTOS); 
		$re = $soapClient->ListaEstacionamiento();

		$option = '';
		 if(count($re->ListaEstacionamientoResult) > 0){
            for ($i=0; $i < count($re->ListaEstacionamientoResult->Estacionamiento); $i++) { 
            	$id = $re->ListaEstacionamientoResult->Estacionamiento[$i]->id;
            	$sel = "";
            	if($id == $a){
            		$sel = "selected";
            	}
            	$option .=	'<option value="'.$id.'" '.$sel.'>'.$id.'</option>';
            }
        }
		return $option;
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

	public function validar_reserva($a){
		/*
			1 = agregar
			2 = editar
			3 = 
		*/
		$this->error = "false";
		switch (true) {
			case ( (strlen($a['estacionamiento']) == 0)):
				$this->msj = "Ingrese estacionamiento.";
				break;
			case ( (strlen($a['fecha']) == 0)):
				$this->msj = "Ingrese fecha.";
				break;
			default:
				$this->ModificarReserva($a);

				$this->error = "true";
				$this->msj  = "Reserva editado con exito.";
		}
		return $this->res;
	}

	public function ObtenerReserva($a = null){
		try{
			$soapClient = new SoapClient(WSDL_RESERVAS); 
			$re = $soapClient->ObtenerReserva(array("reserva_id" => $a));
			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}

	public function ModificarReserva($a = null){
		try{
			$id       			= $a['id'];
			$estacionamiento 	= $a['estacionamiento'];
			$fecha			 	= $a['fecha'];
			$estado			 	= $a['estado'];

			$soapClient = new SoapClient(WSDL_RESERVAS); 

			$parametros['reserva']['id']					=	$id;
			$parametros['reserva']['estacionamiento_id']	=	$estacionamiento;
			$parametros['reserva']['fecha']					=	$fecha;
			$parametros['reserva']['estado']				=	$estado;

			$re = $soapClient->ModificarReserva($parametros);

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}

	public function EliminarUsuario($a = null){
		try{
			$soapClient = new SoapClient(WSDL_USUARIOS); 

			$re = $soapClient->EliminarUsuario(array("usuario_id" => $a));

			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}


}

?>