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
			$this->form_validation->set_rules('existencia', 'Cantidad de productos', 'required');
			$this->form_validation->set_rules('subtotal', 'Costo Total', 'required');
			$this->form_validation->set_rules('serie', 'No. de serie de factura', 'required');
			$this->form_validation->set_rules('folio', 'Folio de factura', 'required');
			$this->form_validation->set_rules('fecha', 'Fecha', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$ajax_data = array(
					'nombreProducto'=> $this->input->post("nombreProducto"),
					'costo'=> $this->input->post("costo"),
					'precioPublico'=> $this->input->post("precioPublico"),
					'idProveedores'=> $this->input->post("idProveedores"),
					'numSerie'=> $this->input->post("numSerie"),
					'marca'=> $this->input->post("marca"),
					'modelo'=> $this->input->post("modelo"),
					'tipo'=> $this->input->post("tipo"),
					'existencia'=> $this->input->post("existencia"),
				);
				$ajax_dato = array(
					'serie'=> $this->input->post("serie"),
					'folio'=> $this->input->post("folio"),
					'subtotal'=> $this->input->post("subtotal"),
					'fecha'=> $this->input->post("fecha"),
					'idProveedores'=> $this->input->post("idProveedores"),
				);
				if($this->Productos_modelo->agregarProducto($ajax_data) && $this->Productos_modelo->agregarEgreso($ajax_dato)){
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
			/* $idProveedor = $this->input->post('idProveedor'); */

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
			$this->form_validation->set_rules('subtotal', 'Costo Total', 'required');
			$this->form_validation->set_rules('serie', 'No. de serie de facturatal', 'required');
			$this->form_validation->set_rules('folio', 'Folio de factura', 'required');
			$this->form_validation->set_rules('fecha', 'Fecha', 'required');
			
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				
				$data['idProductos'] = $this->input->post('idProductos');
				$data['existencia'] = $this->input->post('total');
				

				
					$dato['serie'] = $this->input->post("serie");
					$dato['folio'] = $this->input->post("folio");
					$dato['subtotal'] = $this->input->post("subtotal");
					$dato['fecha'] = $this->input->post("fecha");
					$dato['idProveedores'] = $this->input->post("idProveedores");
				

				if($this->Productos_modelo->actualizarStock($data) && $this->Productos_modelo->agregarEgreso($dato)){
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

	public function productosMasVendidos() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Productos_modelo->productosMasVendidos()) {
				$data = array('response' => 'success', 'posts' => $posts);
			} else {
				$data = array('response' => 'error', 'message' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
    }
}