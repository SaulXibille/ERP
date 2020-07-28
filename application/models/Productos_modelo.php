<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_modelo extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function obtenerProductos(){

        $this->db->select('productos.nomProducto, productos.costo, productos.precioPublico, productos.status, productos.numSerie,
        productos.marca, productos.modelo, productos.tipo, proveedores.proveedor');
        $this->db->from('productos productos');
        $this->db->join('proveedores proveedor', 'productos.idProveedores = producto.idProveedores');

        $res = $this->db->get();

        if($res->num_rows() > 0) {
            $r = $res->row();
            return 1;
        }else{
            return 0;
        }
    }
}