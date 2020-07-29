<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Colaboradores_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
	}

	public function index() {
		// $data['mensaje'] = '';
		$this->load->view('colaboradores');
	}

	public function agregar() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nombres', 'Nombres', 'required');
			$this->form_validation->set_rules('apellidoP', 'Apellido Paterno', 'required');
			$this->form_validation->set_rules('apellidoM', 'Apellido Materno', 'required');
			$this->form_validation->set_rules('idPuestos', 'Puesto', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if($this->Colaboradores_modelo->agregarEmpleado($ajax_data)){
					$data = array('respuesta' => 'exito', 'mensaje' => 'Añadido con exito');
				} else {
					$data = array('respuesta' => 'error', 'mensaje' => 'Error al agregar');
				}
			}

			echo json_encode($data);
			// echo "ajax request";
		} else {
			
		}
	}

	public function obtenerEmpleados() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Colaboradores_modelo->obtenerEmpleados()) {
				$data = array('response' => 'success', 'posts' => $posts);
			} else {
				$data = array('response' => 'error', 'message' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
	}
}
