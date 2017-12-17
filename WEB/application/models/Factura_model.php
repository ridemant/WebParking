<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

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
	
	public function getRes(){ return $this->res; }



	///////////////////////////////////////////////////////////////////////////

	public function listar(){
		$soapClient = new SoapClient(WSDL_USUARIOS); 

		$re = $soapClient->ListaUsuario();

		return $re;
	}

	public function validar_usuario($a, $b){
		/*
			1 = agregar
			2 = editar
			3 = 
		*/
		$this->res["res"] = "false";
		switch (true) {
			
			case ( (strlen($a['nombres']) == 0)):
				$this->res["msj"] = "Ingresa sus Nombres";
				break;
			case ( (strlen($a['appaterno']) == 0)):
				$this->res["msj"] = "Ingresa Apellido Paterno";
				break;
			case ( (strlen($a['apmaterno']) == 0)):
				$this->res["msj"] = "Ingresa Apellido Materno";
				break;
			case ( (strlen($a['correo']) == 0)):
				$this->res["msj"] = "Ingresa Correo Electronico";
				break;
			case ( (strlen($a['usuario']) == 0)):
				$this->res["msj"] = "Ingresa nombre de Usuario";
				break;
			case ( (strlen($a['clave']) == 0)):
				$this->res["msj"] = "Ingresa Clave";
				break;
			case ( (strlen($a['dni']) == 0)):
				$this->res["msj"] = "Ingresa DNI";
				break;
			case ( (strlen($a['tipo']) == 0)):
				$this->res["msj"] = "Ingresa Tipo de Usuario";
				break;
			case ( (strlen($a['saldo']) == 0)):
				$this->res["msj"] = "Ingresa Saldo";
				break;
			default:

				if($b == 1) $this->CrearUsuario($a); 
				else $this->ModificarEstacionamiento($a);

				$this->res["res"] = "true";
				$this->res["msj"] = ($b == 1) ? "Sucursal insertado con exito." : "Sucursal editado con exito.";
				
		}
		return $this->res;
	}


	public function CrearUsuario($a = null){

		try{
			$nombres 	= $a['nombres'];
			$appaterno 	= $a['appaterno'];
			$apmaterno 	= $a['apmaterno'];
			$correo 	= $a['correo'];
			$usuario 	= $a['usuario'];
			$clave 		= $a['clave'];
			$dni 		= $a['dni'];
			$tipo 		= $a['tipo'];
			$saldo 		= $a['saldo'];

			$soapClient = new SoapClient(WSDL_USUARIOS); 

			$parametros['usuario']['id']			=	0;
			$parametros['usuario']['nombres']		=	$nombres;
			$parametros['usuario']['appaterno']		=	$appaterno;
			$parametros['usuario']['apmaterno']		=	$apmaterno;
			$parametros['usuario']['correo']		=	$correo;
			$parametros['usuario']['usuario']		=	$usuario;
			$parametros['usuario']['contrasena']	=	$clave;
			$parametros['usuario']['dni']			=	$dni;
			$parametros['usuario']['tipo']			=	$tipo;
			$parametros['usuario']['saldo']			=	$saldo;

			 $re = $soapClient->CrearUsuario($parametros);

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}

	}

	public function ObtenerUsuario($a = null){
		try{
			$soapClient = new SoapClient(WSDL_USUARIOS); 
			$re = $soapClient->ObtenerUsuario(array("usuario_id" => $a));
			return $re;
		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		       return null;
		}
	}

	public function ModificarUsuario($a = null){
		try{
			$id       	= $a['id'];
			$nombres 	= $a['nombres'];
			$appaterno 	= $a['appaterno'];
			$apmaterno 	= $a['apmaterno'];
			$correo 	= $a['correo'];
			$usuario 	= $a['usuario'];
			$clave 		= $a['clave'];
			$dni 		= $a['dni'];
			$tipo 		= $a['tipo'];
			$saldo 		= $a['saldo'];

			
			$soapClient = new SoapClient(WSDL_USUARIOS); 

			$parametros['usuario']['id']			=	$id;
			$parametros['usuario']['nombres']		=	$nombres;
			$parametros['usuario']['appaterno']		=	$appaterno;
			$parametros['usuario']['apmaterno']		=	$apmaterno;
			$parametros['usuario']['correo']		=	$correo;
			$parametros['usuario']['usuario']		=	$usuario;
			$parametros['usuario']['contrasena']	=	$clave;
			$parametros['usuario']['dni']			=	$dni;
			$parametros['usuario']['tipo']			=	$tipo;
			$parametros['usuario']['saldo']			=	$saldo;

			$re = $soapClient->ModificarUsuario($parametros);

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
