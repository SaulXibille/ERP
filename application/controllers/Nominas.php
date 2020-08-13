<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nominas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Nominas_modelo');
		$this->load->model('Colaboradores_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
			$data['titulo'] = 'Nominas';
			$data['empleados'] = $this->Colaboradores_modelo->obtenerEmpleadosActivos();
			$this->load->view('Nominas/nominas', $data);
		} else {
			$this->load->view('login');
		}
	}

	public function obtenerNominas() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Nominas_modelo->obtenerNominas()) {
				$data = array('response' => 'success', 'posts' => $posts);
			} else {
				$data = array('response' => 'error', 'message' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
	}

	public function filtrarNominas() {
		if($this->input->is_ajax_request()) {
			$status = $this->input->post('status');

			if($posts = $this->Nominas_modelo->filtrarNominas($status)){
				$data = array('respuesta' => 'exito', 'posts' => $posts);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}

	public function agregar() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('idEmpleados', 'Empleado', 'required');
			$this->form_validation->set_rules('sueldo', 'Sueldo', 'required');
			$this->form_validation->set_rules('imss', 'NSS', 'required');
			$this->form_validation->set_rules('pension', 'Pension', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if($this->Nominas_modelo->agregarNomina($ajax_data)){
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

	public function cambiarStatus() {
		if($this->input->is_ajax_request()) {
			$idNomina = $this->input->post('idNomina');
			$status = $this->input->post('status');

			if($this->Nominas_modelo->cambiarStatus($idNomina, $status)){
				$data = array('respuesta' => 'exito');
			} else {
				$data = array('respuesta' => 'error');
			}
			echo json_encode($data);
		} else {

		}
    }

	public function eliminar() {
		if($this->input->is_ajax_request()) {
			$idNomina = $this->input->post('idNomina');

			if($this->Nominas_modelo->eliminarNomina($idNomina)){
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
			$idNomina = $this->input->post('idNomina');

			if($post = $this->Nominas_modelo->modificarNomina($idNomina)){
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
			$this->form_validation->set_rules('idEmpleados', 'Empleado', 'required');
			$this->form_validation->set_rules('sueldo', 'Sueldo', 'required');
			$this->form_validation->set_rules('imss', 'NSS', 'required');
			$this->form_validation->set_rules('pension', 'Pension', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$data['idNominas'] = $this->input->post('idNominas');
				$data['sueldo'] = $this->input->post('sueldo');
				$data['imss'] = $this->input->post('imss');
				$data['pension'] = $this->input->post('pension');
				$data['idEmpleados'] = $this->input->post('idEmpleados');

				if($this->Nominas_modelo->actualizarNomina($data)){
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

	public function detalle() {
		if($this->input->is_ajax_request()) {
			$idNomina = $this->input->post('idNomina');

			if($post = $this->Nominas_modelo->detalleNomina($idNomina)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}
}
