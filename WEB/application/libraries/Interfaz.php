<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interfaz {


	function __construct(){ 
		$this->CI = &get_instance(); 
	}

	public function contenedorAdmin($archivo = array()){
		$this->CI->load->view(DIR_ACCESO.'componentes/inicio', $archivo);
	}

	public function contenedor($archivo, $arregloArchivo = array(), $var = array() ){

			$this->CI->load->view(DIR.'superior', $var);
			$this->CI->load->view($archivo, $arregloArchivo);
			$this->CI->load->view(DIR.'inferior');

	}
	
	public function contenedorReproductor($archivo, $arregloArchivo = array() ){
			$this->CI->load->view($archivo, $arregloArchivo);
	}


}