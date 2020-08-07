<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ventas extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ventas_modelo');
		$this->load->model('Productos_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
			$data['titulo'] = 'Ventas';
			// $data['puestos'] = $this->Puestos_modelo->obtenerPuestosActivos();
			$this->load->view('Ventas/ventas', $data);
		} else {
			$this->load->view('login');
		}
	}

	public function obtenerVentas() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Ventas_modelo->obtenerVentas()) {
				$data = array('respuesta' => 'exito', 'posts' => $posts);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
	}

	public function obtenerProductosActivos() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Productos_modelo->obtenerProductosActivos()) {
				$data = array('respuesta' => 'exito', 'posts' => $posts);
			} else {
				$data = array('respuesta' => 'error', 'message' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
	}

	public function obtenerProductoId() {
		if($this->input->is_ajax_request()) {
			$idProducto = $this->input->post('idProducto');

			if($post = $this->Productos_modelo->obtenerProductoId($idProducto)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}

	public function filtrarVentas() {
		if($this->input->is_ajax_request()) {
			$status = $this->input->post('status');

			if($posts = $this->Ventas_modelo->filtrarVentas($status)){
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

	public function cambiarStatus() {
		if($this->input->is_ajax_request()) {
			$idVenta = $this->input->post('idVenta');
			$status = $this->input->post('status');

			if($this->Ventas_modelo->cambiarStatus($idVenta, $status)){
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

	public function detalle() {
		if($this->input->is_ajax_request()) {
			$idEmpleado = $this->input->post('idEmpleado');

			if($post = $this->Colaboradores_modelo->detalleEmpleado($idEmpleado)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}

}
