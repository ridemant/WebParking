<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session {

	function __construct(){ 
		session_start();
		$this->CI = &get_instance(); 
	}

	public function Logueado(){
		$id =  isset($_SESSION["ID"]) ? $_SESSION["ID"] : null ;
			return (is_numeric($id) && (int)$id > 0);
	}

	public function iniciarSesion($id){
		$_SESSION["ID"] = $id;

		header("Location: ".BASE_URL."inicio/panel");
		exit;
		//redirect($this->ruta_tablero);
	}
	public function verificarSesion(){
		if(!$this->Logueado()){
			header("Location: ".BASE_URL."admin");
			exit;
		}
	}
	public function cerrarSesion(){
		unset($_SESSION['ID']);
		session_unset('ID');
		session_destroy();
		header("Location: ".BASE_URL."admin");
		exit;
	}

}

?>