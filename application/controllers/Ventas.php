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

	public function filtrarVentasMes() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Ventas_modelo->filtrarVentasMes()){
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
			$this->form_validation->set_rules('subtotal', 'Subtotal', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if($post = $this->Ventas_modelo->agregarVenta($ajax_data)){
					$data = array('respuesta' => 'exito', 'mensaje' => 'Añadido con exito', 'post' => $post);
				} else {
					$data = array('respuesta' => 'error', 'mensaje' => 'Error al agregar');
				}
			}

			echo json_encode($data);
			// echo "ajax request";
		} else {
			
		}
	}

	public function agregarDetalleVentas() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('idVenta', 'Subtotal', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$idVenta1 = $this->input->post(array('idVenta'));
				$lista = $this->input->post(array('lista'));

				$idVenta = $idVenta1['idVenta'];

				$datos = $lista['lista'];
				$total = count($datos);

				for ($i = 0; $i < $total; ++$i){
					$idProducto = $datos[$i]['idProducto'];
					$cantidad = $datos[$i]['cantidad'];
					$data['idVentas'] = $idVenta;
					$data['idProductos'] = $idProducto;
					$data['cantidad'] = $cantidad;
					$post = $this->Ventas_modelo->agregarDetalleVentas($data);
					$this->Productos_modelo->restarStock($cantidad, $idProducto);
				}

				$data2 = array('respuesta' => 'exito', 'mensaje' => 'Añadido con exito', 'post' => $post);
				echo json_encode($data2);
			}
		} else {
			
		}
	}

	public function cambiarStatus() {

		function objectToArray($data) {

			if (is_object($data)) {
					$data = get_object_vars($data);
			}
	
			if (is_array($data)) {
					return array_map(__FUNCTION__, $data);
			}
			else {
					return $data;
			}
		}

		if($this->input->is_ajax_request()) {
			$idVenta = $this->input->post('idVenta');
			$status = $this->input->post('status');
			$mensaje = $this->input->post('mensaje');

			if($posts = $this->Ventas_modelo->cambiarStatus($idVenta, $status)){
				$data = array('respuesta' => 'exito', 'posts' => $posts);
				$total = count($posts);
				$post = objectToArray($posts);
				for ($i = 0; $i < $total; ++$i){
					$idProducto = $post[$i]['idProductos'];
					$cantidad = $post[$i]['cantidad'];
					if($mensaje == 'sumarStock') {
						$this->Productos_modelo->sumarStock($cantidad, $idProducto);
					}else {
						$this->Productos_modelo->restarStock($cantidad, $idProducto);
					}
				}
			} else {
				$data = array('respuesta' => 'error');
			}
			echo json_encode($data);
		} else {

		}
	}

	public function detalle() {
		if($this->input->is_ajax_request()) {
			$idVenta = $this->input->post('idVenta');

			if($post = $this->Ventas_modelo->detalleVenta($idVenta)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}

}
