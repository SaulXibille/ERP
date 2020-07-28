<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Productos_modelo');
    }

    public function index(){
        $this->load->view('productos');
    }
}