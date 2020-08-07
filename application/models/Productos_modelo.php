<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_modelo extends CI_Model {
    public function __construct(){
        parent::__construct();
    }

    public function obtenerProductos(){

        $this->db->select('produc.nombreProducto, produc.marca, produc.costo, produc.precioPublico, produc.sku, produc.status, produc.numSerie, produc.modelo, produc.tipo, prov.razonSocial, produc.idProductos, produc.existencia');
        $this->db->from('productos produc');
        $this->db->join('proveedores prov', 'produc.idProveedores = prov.idProveedores');
        

        $res = $this->db->get();

        if($res->num_rows() > 0) {
            $r = $res->row();
            return $res->result();
        }else{
            return 0;
        }
    }

    public function obtenerProductosActivos(){

      $this->db->select('produc.nombreProducto, produc.marca, produc.costo, produc.precioPublico, produc.sku, produc.status, produc.numSerie, produc.modelo, produc.tipo, prov.razonSocial, produc.idProductos, produc.existencia');
      $this->db->from('productos produc');
      $this->db->join('proveedores prov', 'produc.idProveedores = prov.idProveedores');
      $this->db->where('produc.status', 1);
  
      $res = $this->db->get();
  
      if($res->num_rows() > 0) {
        $r = $res->row();
        return $res->result();
      }else {
        return 0;
      }
    }

    public function obtenerProductoId($idProducto){
      $this->db->select('produc.nombreProducto, produc.marca, produc.costo, produc.precioPublico, produc.sku, produc.status, produc.numSerie, produc.modelo, produc.tipo, prov.razonSocial, produc.idProductos');
      $this->db->from('productos produc');
      $this->db->join('proveedores prov', 'produc.idProveedores = prov.idProveedores');
      $this->db->where('produc.idProductos', $idProducto);

      $res = $this->db->get();

      if($res->num_rows() > 0) {
          return $res->row();
      }else{
          return 0;
      }
    }

    public function filtrarProductos($status) {
      $this->db->select('produc.nombreProducto, produc.marca, produc.costo, produc.precioPublico, produc.sku, produc.status, produc.numSerie, produc.modelo, produc.tipo, prov.razonSocial, produc.idProductos, produc.existencia');
      $this->db->from('productos produc');
      $this->db->join('proveedores prov', 'produc.idProveedores = prov.idProveedores');
      $this->db->where('produc.status', $status);
  
      $res = $this->db->get();
  
      if($res->num_rows() > 0) {
        $r = $res->row();
        return $res->result();
      }else {
        return 0;
      }
    }

    public function agregarProducto($data) {
        return $this->db->insert('productos', $data);
      }

      public function cambiarStatus($idProducto,$status) {
        if($status == "desactivar") {
          $status = 0;
        } else {
          $status = 1;
        }
        $this->db->where('idProductos', $idProducto);
        $this->db->set('status', $status);
        $this->db->update('productos');
        return ($this->db->affected_rows() > 0);
      }
    
      public function modificarStock($idProducto) {
        $this->db->select("produc.idProductos, produc.existencia, produc.nombreProducto");
        $this->db->from('productos produc');
        $this->db->where('idProductos', $idProducto);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
      }
    
      public function actualizarStock($data) {
        return $this->db->update('productos', $data, array('idProductos' => $data['idProductos']));
      }
    

      public function modificarProducto($idProducto) {
        $this->db->select("*");
        $this->db->from('productos');
        $this->db->where('idProductos', $idProducto);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
      }
    
      public function actualizarProducto($data) {
        return $this->db->update('productos', $data, array('idProductos' => $data['idProductos']));
      }
    
      public function detalleProducto($idProducto) {
        $this->db->select("*");
        $this->db->from('productos');
        $this->db->where('idProductos', $idProducto);
        $res = $this->db->get();
        if(count($res->result()) > 0) {
          return $res->row();
        }
      }
}