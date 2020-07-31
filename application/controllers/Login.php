<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Login_modelo');
	}

	public function index() {
		$this->load->view('login');
	}

	public function ingresar() {
		$correo = $this->input->post('correo');
		$contraseña = $this->input->post('contraseña');
		
		$res = $this->Login_modelo->ingresar($correo, $contraseña);

		if($res) {
			$s_data = array(
				's_idUsuario' => $res->idUsuarios,
				's_idEmpleado' => $res->idEmpleados,
				's_nombreUsuario' => $res->nombres,
				's_puesto' => $res->nombrePuesto,
				's_status' => $res->status,
				'is_logged' => TRUE,
			);
	
			$this->session->set_userdata($s_data);
		} else {
			echo "error";
		}

		// echo json_encode(array('url' => base_url('Colaboradores/colaboradores')));
		// $this->load->view('Colaboradores/colaboradores');
	}

	public function logout() {
		$this->session->sess_destroy();//-destruye la sesion actual
    header('Location: '.base_url());
	}
}
