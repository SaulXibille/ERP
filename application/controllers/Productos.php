<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller{
    public function __construct(){
        parent::__construct();
		$this->load->model('Productos_modelo');
		$this->load->model('Proveedores_modelo');
        $this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
    }

    public function index(){
        if($this->session->userdata('is_logged')) {
			 $data['titulo'] = 'Productos';
			 $data['proveedores'] = $this->Proveedores_modelo->obtenerProveedores();
			$this->load->view('Productos/productos', $data);
		} else {
			$this->load->view('login');
		}
    }

    public function obtenerProductos() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Productos_modelo->obtenerProductos()) {
				$data = array('response' => 'success', 'posts' => $posts);
			} else {
				$data = array('response' => 'error', 'message' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
    }
	
	public function filtrarProductos() {
		if($this->input->is_ajax_request()) {
			$status = $this->input->post('status');

			if($posts = $this->Productos_modelo->filtrarProductos($status)){
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
			$this->form_validation->set_rules('nombreProducto', 'Nombre', 'required');
			$this->form_validation->set_rules('costo', 'Costo', 'required');
            $this->form_validation->set_rules('precioPublico', 'Precio al Publico', 'required');
            $this->form_validation->set_rules('idProveedores', 'Proveedor', 'required');
            $this->form_validation->set_rules('numSerie', 'Numero de Serie', 'required');
            $this->form_validation->set_rules('marca', 'Marca', 'required');
            $this->form_validation->set_rules('modelo', 'Modelo', 'required');
			$this->form_validation->set_rules('tipo', 'Tipo', 'required');
			$this->form_validation->set_rules('sku', 'sku', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if($this->Productos_modelo->agregarProducto($ajax_data)){
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
			$idProducto = $this->input->post('idProducto');
			$status = $this->input->post('status');

			if($this->Productos_modelo->cambiarStatus($idProducto, $status)){
				$data = array('respuesta' => 'exito');
			} else {
				$data = array('respuesta' => 'error');
			}
			echo json_encode($data);
		} else {

		}
    }
	
	public function stock() {
		if($this->input->is_ajax_request()) {
			$idProducto = $this->input->post('idProducto');

			if($post = $this->Productos_modelo->modificarStock($idProducto)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
    }
    
    public function actualizarStock() {
		if($this->input->is_ajax_request()) {
			$this->form_validation->set_rules('total', 'total', 'required');
			
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$data['idProductos'] = $this->input->post('idProductos');
				$data['existencia'] = $this->input->post('total');

				if($this->Productos_modelo->actualizarStock($data)){
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

    public function modificar() {
		if($this->input->is_ajax_request()) {
			$idProducto = $this->input->post('idProducto');

			if($post = $this->Productos_modelo->modificarProducto($idProducto)){
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
			$this->form_validation->set_rules('nombreProducto', 'Nombre', 'required');
			$this->form_validation->set_rules('costo', 'Costo', 'required');
            $this->form_validation->set_rules('precioPublico', 'Precio al Publico', 'required');
            $this->form_validation->set_rules('idProveedores', 'Proveedor', 'required');
            $this->form_validation->set_rules('numSerie', 'Numero de Serie', 'required');
            $this->form_validation->set_rules('marca', 'Marca', 'required');
            $this->form_validation->set_rules('modelo', 'Modelo', 'required');
            $this->form_validation->set_rules('tipo', 'Tipo', 'required');
			$this->form_validation->set_rules('sku', 'SKU', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$data['idProductos'] = $this->input->post('idProductos');
				$data['nombreProducto'] = $this->input->post('nombreProducto');
				$data['costo'] = $this->input->post('costo');
				$data['precioPublico'] = $this->input->post('precioPublico');
				$data['numSerie'] = $this->input->post('numSerie');
                $data['marca'] = $this->input->post('marca');
                $data['modelo'] = $this->input->post('modelo');
				$data['tipo'] = $this->input->post('tipo');
				$data['sku'] = $this->input->post('sku');
                $data['idProveedores'] = $this->input->post('idProveedores');

				if($this->Productos_modelo->actualizarProducto($data)){
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
			$idProducto = $this->input->post('idProducto');

			if($post = $this->Productos_modelo->detalleProducto($idProducto)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}
}