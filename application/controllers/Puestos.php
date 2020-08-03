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
      $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
      $this->form_validation->set_rules('contraseña', 'Contraseña', 'required');
			$this->form_validation->set_rules('idEmpleados', 'Colaborador', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
        $ajax_data = $this->input->post(array('contraseña', 'correo', 'idEmpleados'));
        // print_r($ajax_data);
				if($this->Usuarios_modelo->agregarUsuario($ajax_data)){
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
			$idUsuario = $this->input->post('idUsuario');

			if($this->Usuarios_modelo->eliminarUsuario($idUsuario)){
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
			$idUsuario = $this->input->post('idUsuario');

			if($post = $this->Usuarios_modelo->modificarUsuario($idUsuario)){
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
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
      $this->form_validation->set_rules('contraseña', 'Contraseña', 'required');
			$this->form_validation->set_rules('idEmpleados', 'Colaborador', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
        $data['idEmpleados'] = $this->input->post('idEmpleados');
        $data['contraseña'] = $this->input->post('contraseña');
				$data['correo'] = $this->input->post('correo');
				$data['idUsuarios'] = $this->input->post('idUsuarios');

				if($this->Usuarios_modelo->actualizarUsuario($data)){
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
			$idUsuario = $this->input->post('idUsuario');

			if($post = $this->Usuarios_modelo->detalleUsuario($idUsuario)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}
}
