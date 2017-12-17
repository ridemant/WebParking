<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estacionamientos_model extends CI_Model {

	private $usuario;
	private $clave;

    // Lista de errores y resultados
	public $error = array();
	public $res;
	public $msj;

	function __construct(){
		//$this->db = $this->load->library('DB');
		parent::__construct();
		$this->load->library('Session');
	}
	
	public function getRes(){ return $this->res; }



	///////////////////////////////////////////////////////////////////////////

	public function listar(){
		$soapClient = new SoapClient(WSDL_ESTACIONAMIENTOS); 

		$re = $soapClient->ListaEstacionamiento();

		return $re;
	}

	public function listar_sucursales($a = null){
		$soapClient = new SoapClient(WSDL_SUCURSAL); 
		$re = $soapClient->ListaSucursal();

		$option = '';
		 if(count($re->ListaSucursalResult->Sucursal) > 0){
            for ($i=0; $i < count($re->ListaSucursalResult->Sucursal); $i++) { 
            	$id = $re->ListaSucursalResult->Sucursal[$i]->id;
            	$nombre = $re->ListaSucursalResult->Sucursal[$i]->nombre;
            	$sel = "";
            	if($id == $a){
            		$sel = "selected";
            	}
            	$option .=	'<option value="'.$id.'" '.$sel.'>'.$nombre.'</option>';
            }
        }
		return $option;
	}

	public function validar_estacionamiento($a, $b){
		/*
			1 = agregar
			2 = editar
			3 = 
		*/
		$this->error = "false";
		switch (true) {
			
			case ( (strlen($a['numero']) == 0)):
				$this->msj = "Ingresa numero.";
				break;
			case ( (strlen($a['piso']) == 0)):
				$this->msj = "Ingresa piso.";
				break;
			default:

				if($b == 1) $this->CrearEstacionamiento($a); 
				else $this->ModificarEstacionamiento($a);

				$this->error = "true";
				$this->msj = ($b == 1) ? "Sucursal insertado con exito." : "Sucursal editado con exito.";
				
		}
		return $this->res;
	}


	public function CrearEstacionamiento($a = null){

		try{
			$sucursal = $a['sucursal'];
			$numero = $a['numero'];
			$piso = $a['piso'];

			$soapClient = new SoapClient(WSDL_ESTACIONAMIENTOS); 

			$parametros['estacionamiento']['id']			=	0;
			$parametros['estacionamiento']['estado']		=	0;
			$parametros['estacionamiento']['idsucursal']	=	$sucursal;
			$parametros['estacionamiento']['numero']		=	$numero;
			$parametros['estacionamiento']['piso']			=	$piso;

			 $re = $soapClient->CrearEstacionamiento($parametros);

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}

	}

	public function ObtenerEstacionamiento($a = null){
		try{
			$soapClient = new SoapClient(WSDL_ESTACIONAMIENTOS); 
			$re = $soapClient->ObtenerEstacionamiento(array("estacionamiento_id" => $a));
			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}
	
	public function obtenerNombreSucursal($a = null){
		try{
			$soapClient = new SoapClient(WSDL_SUCURSAL); 

			$re = $soapClient->ObtenerSucursal(array("sucursal_id" => $a));

			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}

	public function ModificarEstacionamiento($a = null){
		try{
			$id       	= $a['id'];
			$sucursal 	= $a['sucursal'];
			$numero 	= $a['numero'];
			$piso 		= $a['piso'];

			
			$soapClient = new SoapClient(WSDL_ESTACIONAMIENTOS); 

			$parametros['estacionamiento']['id']			=	$id;
			$parametros['estacionamiento']['estado']		=	0;
			$parametros['estacionamiento']['idsucursal']	=	$sucursal;
			$parametros['estacionamiento']['numero']		=	$numero;
			$parametros['estacionamiento']['piso']			=	$piso;

			$re = $soapClient->ModificarEstacionamiento($parametros);

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}

	public function EliminarEstacionamiento($a = null){
		try{
			$soapClient = new SoapClient(WSDL_ESTACIONAMIENTOS); 

			$re = $soapClient->EliminarEstacionamiento(array("estacionamiento_id" => $a));

			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}


}

?>