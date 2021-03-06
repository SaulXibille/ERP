<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
    $this->load->model('Usuarios_modelo');
    $this->load->model('Colaboradores_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
      $data['titulo'] = 'Usuarios';
      $data['colaboradores'] = $this->Colaboradores_modelo->obtenerEmpleadosActivos();
			$this->load->view('Usuarios/usuarios', $data);
		} else {
			$this->load->view('login');
		}
	}

	public function filtrarUsuarios() {
		if($this->input->is_ajax_request()) {
			$status = $this->input->post('status');

			if($posts = $this->Usuarios_modelo->filtrarUsuarios($status)){
				$data = array('respuesta' => 'exito', 'posts' => $posts);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}

	public function obtenerUsuarios() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Usuarios_modelo->obtenerUsuarios()) {
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
				// $contraseña = md5($this->input->post('contraseña'));
				// $this->input->post(array($contraseña, 'correo', 'idEmpleados'));
				$ajax_data = array(
					'contraseña' => md5($this->input->post("contraseña")),
					'correo'=> $this->input->post("correo"),
					'idEmpleados'=> $this->input->post("idEmpleados"), 
				);
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

	public function cambiarStatus() {
		if($this->input->is_ajax_request()) {
			$idUsuario = $this->input->post('idUsuario');
			$status = $this->input->post('status');

			if($this->Usuarios_modelo->cambiarStatus($idUsuario, $status)){
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
        $data['contraseña'] = md5($this->input->post('contraseña'));
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

	public function actualizar2() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
      // $this->form_validation->set_rules('contraseña', 'Contraseña', 'required');
			$this->form_validation->set_rules('idEmpleados', 'Colaborador', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
        $data['idEmpleados'] = $this->input->post('idEmpleados');
        // $data['contraseña'] = md5($this->input->post('contraseña'));
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
