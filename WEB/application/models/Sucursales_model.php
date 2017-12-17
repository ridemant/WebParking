<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sucursales_model extends CI_Model {

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
	
	public function setUsuario($usuario){ $this->usuario = strtolower($usuario);}
	public function getUsuario(){return $this->usuario;}

	public function setClave($clave){ $this->clave = $clave;}
	public function getClave(){return $this->clave;}

	public function getRes(){ return $this->res; }



	///////////////////////////////////////////////////////////////////////////

	public function listar(){
		$wsdl = WSDL_SUCURSAL;
		$soapClient = new SoapClient($wsdl); 

		$re = $soapClient->ListaSucursal();

		return $re;
	}

	public function validar_sucursal($a, $b){
		/*
			1 = agregar
			2 = editar
		*/
		$this->error = "false";
		switch (true) {
			case ( (strlen($a['sucursal']) == 0)):
				$this->msj = "Ingresa nombre de sucursal.";
				break;
			case ( (strlen($a['tarifa']) == 0)):
				$this->msj = "Ingresa tarifa de sucursal.";
				break;
			default:

				if($b == 1) $this->add_sucursal($a); 
				else $this->ModificarSucursal($a);

				$this->error = "true";
				$this->msj = ($b == 1) ? "Sucursal insertado con exito." : "Sucursal editado con exito.";
		}
		return $this->res;
	}


	public function add_sucursal($a = null){

		try{
			$sucursal = $a['sucursal'];
			$tarifa = $a['tarifa'];

			$wsdl = WSDL_SUCURSAL;
			$soapClient = new SoapClient($wsdl); 

			$parametros['sucursal']['id']		=	0;
			$parametros['sucursal']['nombre']	=	$sucursal;
			$parametros['sucursal']['tarifa']	=	$tarifa;

			 $re = $soapClient->CrearSucursal($parametros);
		     //var_dump($re);

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}

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

	public function ModificarSucursal($a = null){
		try{
			$id       	= $a['id'];
			$sucursal 	= $a['sucursal'];
			$tarifa 	= $a['tarifa'];
			
			$soapClient = new SoapClient(WSDL_SUCURSAL); 

			$parametros['sucursal']['id']		=	$id;
			$parametros['sucursal']['nombre']	=	$sucursal;
			$parametros['sucursal']['tarifa']	=	$tarifa;

			$re = $soapClient->ModificarSucursal($parametros);

			$this->res["res"] = "true";
			$this->res["msj"] = "Sucursal eliminado con exito.";

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}

	public function EliminarSucursal($a = null){
		try{
			$wsdl = WSDL_SUCURSAL;
			$soapClient = new SoapClient($wsdl); 

			$re = $soapClient->EliminarSucursal(array("sucursal_id" => $a));

			$this->res["res"] = "true";
			$this->res["msj"] = "Sucursal eliminado con exito.";

			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}


}

?>