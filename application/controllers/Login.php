<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Login_modelo');
	}

	public function index() {
		$data['mensaje'] = '';
		$this->load->view('login', $data);
	}

	public function ingresar() {
		$correo = $this->input->post('correo');
		$contraseña = $this->input->post('contraseña');
		
		$res = $this->Login_modelo->ingresar($correo, $contraseña);

		if ($res == 1) {
				$this->load->view('inicio');
		} else {
			$data['mensaje'] = "Usuario Inexistente";
			$this->load->view('login', $data);
		}
	}
}
