<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Egresos extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Egresos_modelo');
        $this->load->model('Proveedores_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
			$data['titulo'] = 'Egresos';
			$data['proveedores'] = $this->Proveedores_modelo-> obtenerProveedores();
			$this->load->view('Egresos/egresos', $data);
		} else {
			$this->load->view('login');
		}
	}
    
    public function obtenerEgresos() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Egresos_modelo->obtenerEgresos()) {
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
			$this->form_validation->set_rules('serie', 'Serie', 'required');
			$this->form_validation->set_rules('folio', 'Folio', 'required');
            $this->form_validation->set_rules('subtotal', 'Subtotal', 'required');
            $this->form_validation->set_rules('fecha', 'Fecha', 'required');
			$this->form_validation->set_rules('idProveedores', 'Proveedor', 'required');
			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$ajax_data = $this->input->post();
				if($this->Egresos_modelo->agregarEgreso($ajax_data)){
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
    
    public function detalle() {
		if($this->input->is_ajax_request()) {
			$id_Egresos = $this->input->post('id_Egresos');

			if($post = $this->Egresos_modelo->detalleEgresos($id_Egresos)){
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
			$this->form_validation->set_rules('serie', 'Serie', 'required');
			$this->form_validation->set_rules('folio', 'Folio', 'required');
			$this->form_validation->set_rules('subtotal', 'Subtotal', 'required');
			$this->form_validation->set_rules('fecha', 'Fecha', 'required');
			$this->form_validation->set_rules('idProveedores', 'Proveedor', 'required');

			if($this->form_validation->run() == FALSE) {
				$data = array('respuesta' => 'error', 'mensaje' => validation_errors());
			} else {
				$data['id_Egresos'] = $this->input->post('id_Egresos');
				$data['serie'] = $this->input->post('serie');
				$data['folio'] = $this->input->post('folio');
				$data['subtotal'] = $this->input->post('subtotal');
				$data['fecha'] = $this->input->post('fecha');
				$data['idProveedores'] = $this->input->post('idProveedores');

				if($this->Egresos_modelo->actualizarEgreso($data)){
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

	public function filtrarEgresos() {
		if($this->input->is_ajax_request()) {
			$status = $this->input->post('status');

			if($posts = $this->Egresos_modelo->filtrarEgresos($status)){
				$data = array('respuesta' => 'exito', 'posts' => $posts);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
	}

	public function cambiarStatus() {
		if($this->input->is_ajax_request()) {
			$id_Egresos = $this->input->post('id_Egresos');
			$status = $this->input->post('status');

			if($this->Egresos_modelo->cambiarStatus($id_Egresos, $status)){
				$data = array('respuesta' => 'exito');
			} else {
				$data = array('respuesta' => 'error');
			}
			echo json_encode($data);
		} else {

		}
	}
	
}
