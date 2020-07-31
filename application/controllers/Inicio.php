<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library(array('form_validation', 'session'));
    }

    public function index(){
      if($this->session->userdata('is_logged')) {
        $data = array(
          'titulo' => 'Inicio',
         );
        $this->load->view('inicio', $data);
      } else {
        $this->load->view('login');
      }
    }
}