<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Proveedores_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
			$data['titulo'] = 'Proveedores'; 
			$this->load->view('Proveedores/proveedores', $data);
		} else {
			$this->load->view('login');
		}
	}

	public function obtenerProveedores() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Proveedores_modelo->obtenerProveedores()) {
				$data = array('response' => 'success', 'posts' => $posts);
			} else {
				$data = array('response' => 'error', 'message' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
	}

	public function filtrarProveedores() {
		if($this->input->is_ajax_request()) {
			$status = $this->input->post('status');

			if($posts = $this->Proveedores_modelo->filtrarProveedores($status)){
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
			$this->form_validation->set_rules('razonSocial', 'Razon Social', 'required');
			$this->form_validation->set_rules('rfc', 'RFC', 'required');
			$this->form_validation->set_rules('giro', 'Giro', 'required');
			
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if($this->Proveedores_modelo->agregarProveedor($ajax_data)){
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
			$idProveedor = $this->input->post('idProveedor');
			$status = $this->input->post('status');

			if($this->Proveedores_modelo->cambiarStatus($idProveedor, $status)){
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
			$idProveedor = $this->input->post('idProveedor');

			if($post = $this->Proveedores_modelo->modificarProveedor($idProveedor)){
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
			$this->form_validation->set_rules('razonSocial', 'Razon Social', 'required');
			$this->form_validation->set_rules('rfc', 'RFC', 'required');
			$this->form_validation->set_rules('giro', 'Giro', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$data['idProveedores'] = $this->input->post('idProveedores');
				$data['razonSocial'] = $this->input->post('razonSocial');
				$data['rfc'] = $this->input->post('rfc');
				$data['giro'] = $this->input->post('giro');

				if($this->Proveedores_modelo->actualizarProveedor($data)){
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
			$idProveedor = $this->input->post('idProveedor');

			if($post = $this->Proveedores_modelo->detalleProveedor($idProveedor)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}
}
