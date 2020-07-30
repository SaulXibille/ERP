<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Colaboradores_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
			$this->load->view('Colaboradores/colaboradores');
		} else {
			$this->load->view('login');
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

	public function eliminar() {
		if($this->input->is_ajax_request()) {
			$idEmpleado = $this->input->post('idEmpleado');

			if($this->Colaboradores_modelo->eliminarEmpleado($idEmpleado)){
				$data = array('respuesta' => 'exito');
			} else {
				$data = array('respuesta' => 'error');
			}
			echo json_encode($data);
		} else {

		}
	}

	public function modificar() {
		if($this->input->is_ajax_request()) {
			$idEmpleado = $this->input->post('idEmpleado');

			if($post = $this->Colaboradores_modelo->modificarEmpleado($idEmpleado)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}

	public function actualizar() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('nombres', 'Nombres', 'required');
			$this->form_validation->set_rules('apellidoP', 'Apellido Paterno', 'required');
			$this->form_validation->set_rules('apellidoM', 'Apellido Materno', 'required');
			$this->form_validation->set_rules('idPuestos', 'Puesto', 'required');
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$data['idEmpleados'] = $this->input->post('idEmpleados');
				$data['nombres'] = $this->input->post('nombres');
				$data['apellidoP'] = $this->input->post('apellidoP');
				$data['apellidoM'] = $this->input->post('apellidoM');
				$data['correo'] = $this->input->post('correo');
				$data['idPuestos'] = $this->input->post('idPuestos');

				if($this->Colaboradores_modelo->actualizarEmpleado($data)){
					$data = array('respuesta' => 'exito', 'mensaje' => 'Actualizado con exito');
				} else {
					$data = array('respuesta' => 'error', 'mensaje' => 'Error al actualizar');
				}
			}

			echo json_encode($data);
			// echo "ajax request";
		} else {

		}
	}
}
