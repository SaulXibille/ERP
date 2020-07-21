<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Colaboradores extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Colaboradores_modelo');
	}

	public function index() {
		// $data['mensaje'] = '';
		$this->load->view('colaboradores');
	}
}
