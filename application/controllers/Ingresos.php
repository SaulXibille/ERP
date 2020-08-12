<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ingresos extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('Ingresos_modelo');
		$this->load->helper(array('form', 'url'));
		$this->load->library(array('form_validation', 'session'));
	}

	public function index() {
		if($this->session->userdata('is_logged')) {
			$data['titulo'] = 'Egresos';
			$this->load->view('Ingresos/ingresos', $data);
		} else {
			$this->load->view('login');
		}
	}
    
    public function obtenerIngresos() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Ingresos_modelo->obtenerIngresos()) {
                $data = array('response' => 'success', 'posts' => $posts);
			} else {
                $data = array('response' => 'error', 'message' => 'No se encontraron registros');
			}
			echo json_encode($data);
		} else {
			
		}
    }
    
	public function filtrarIngresos() {
		if($this->input->is_ajax_request()) {
			if($posts = $this->Ingresos_modelo->filtrarIngresos()){
				$data = array('respuesta' => 'exito', 'posts' => $posts);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
    }
    
    public function detalle() {
		if($this->input->is_ajax_request()) {
			$fecha = $this->input->post('fecha');

			if($post = $this->Ingresos_modelo->detalleIngresos($fecha)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
    }

    public function detalle2() {
		if($this->input->is_ajax_request()) {
			$fecha = $this->input->post('fecha');

			if($post = $this->Ingresos_modelo->detalleIngresos2($fecha)){
				$data = array('respuesta' => 'exito', 'post' => $post);
			} else {
				$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
			}
			echo json_encode($data);
		} else {

		}
		}
		

		public function ingresos_egresos() {
			if($this->input->is_ajax_request()) {
				if($posts = $this->Ingresos_modelo->ingresos_egresos()){
					$data = array('respuesta' => 'exito', 'post' => $posts);
				} else {
					$data = array('respuesta' => 'error', 'mensaje' => 'No se encontro el registro');
				}
				echo json_encode($data);
			} else {

			}
		}
	
	
}
