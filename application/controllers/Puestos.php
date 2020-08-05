<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Puestos extends CI_Controller {

	public function __construct() {
		parent::__construct();
    $this->load->model('Puestos_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
      $data['titulo'] = 'Puestos';
			$this->load->view('Puestos/puestos', $data);
		} else {
			$this->load->view('login');
		}
	}

	public function obtenerPuestos() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Puestos_modelo->obtenerPuestos()) {
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
      $this->form_validation->set_rules('nombrePuesto', 'Nombre Puesto', 'required');
      $this->form_validation->set_rules('entrada', 'Entrada', 'required');
			$this->form_validation->set_rules('salida', 'Salida', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
        $ajax_data = $this->input->post();
        // print_r($ajax_data);
				if($this->Puestos_modelo->agregarPuesto($ajax_data)){
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
			$idPuesto = $this->input->post('idPuesto');

			if($this->Puestos_modelo->eliminarPuesto($idPuesto)){
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
			$idPuesto = $this->input->post('idPuesto');

			if($post = $this->Puestos_modelo->modificarPuesto($idPuesto)){
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
			$this->form_validation->set_rules('nombrePuesto', 'Nombre Puesto', 'required');
      $this->form_validation->set_rules('entrada', 'Entrada', 'required');
			$this->form_validation->set_rules('salida', 'Salida', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
        $data['idPuestos'] = $this->input->post('idPuestos');
        $data['nombrePuesto'] = $this->input->post('nombrePuesto');
				$data['entrada'] = $this->input->post('entrada');
				$data['salida'] = $this->input->post('salida');

				if($this->Puestos_modelo->actualizarPuesto($data)){
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
			$idPuesto = $this->input->post('idPuesto');

			if($post = $this->Puestos_modelo->detallePuesto($idPuesto)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}
}
