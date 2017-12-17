<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

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
	
	public function setUsuario($usuario){ $this->usuario = strtolower($usuario);}
	public function getUsuario(){return $this->usuario;}

	public function setClave($clave){ $this->clave = $clave;}
	public function getClave(){return $this->clave;}

	public function getRes(){ return $this->res; }

	public function procesar(){

		switch (true) {
			case ( strlen($this->getUsuario()) == "" ): 
				$this->error['usuario'] = "false";
				$this->msj = "Nombre de Usuario incorrecto.";
				break;
			case ( strlen($this->getClave()) == "" ): 
				$this->error['clave'] = "false";
				$this->msj = "Clave incorrecta.";
				break;
			default: $this->ingresarLogin();
				break;
		}
	}

	private function ingresarLogin(){

		try{
			$usuario = $this->usuario;
			$clave = $this->clave;

			$soapClient = new SoapClient(WSDL_USUARIOS); 

			$parametros['usuario']		=	$usuario;
			$parametros['contrasena']	=	$clave;

			 $re = $soapClient->AutentificarUsuario($parametros);

			if(isset( $re->AutentificarUsuarioResult->Codigo ) && (int)$re->AutentificarUsuarioResult->Codigo > 0) {
				$this->session->iniciarSesion($re->AutentificarUsuarioResult->Codigo);
				$this->msj = "Login con exito.";
			}else{
				$this->msj = "Error en el login.";
				$this->error['clave'] = "false";
				$this->msj = "Clave incorrecta.";
			}

		} catch (Exception $e) {
		       echo 'Caught exception:',  $e->getMessage(), "\n";
		}

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