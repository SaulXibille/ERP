<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalScrollableTitle">Agregar Venta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar" class="mb-4">
          <div class="">
            <div class="form-row">
              <div class="form-group col-md-3">
                <input type="number" class="form-control" id="idProducto" name="idProducto" style="display: none">
                <label for="nombreProducto">Producto</label>
                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto" disabled> 
              </div>
              <div class="form-group col-md-2">
                <label for="existencia">Existencia</label>
                <input type="number" class="form-control" id="existencia" name="existencia" disabled> 
              </div>
              <div class="form-group col-md-4">
                <label for="vendedor">Vendedor</label>
                <input type="text" class="form-control" id="vendedor" name="vendedor" value="<?php echo $this->session->userdata('s_nombreUsuario');?>" disabled> 
              </div>
              <div class="form-group col-md-3">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" disabled>
              </div>
            </div>
          </div>
          <div class="">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="clienteNombre">Comprador</label>
                <input type="text" class="form-control" id="clienteNombre" name="clienteNombre"> 
              </div>
              <div class="form-group col-md-3">
                <label for="clienteApellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" id="clienteApellidoP" name="clienteApellidoP"> 
              </div>
              <div class="form-group col-md-3">
                <label for="clienteApellidoM">Apellido Materno</label>
                <input type="text" class="form-control" id="clienteApellidoM" name="clienteApellidoM"> 
              </div>
              <div class="form-group col-md-3">
                <label for="clienteContacto">Contacto</label>
                <input type="text" class="form-control" id="clienteContacto" name="clienteContacto">
              </div>
            </div>
          </div>
          <div class="">
            <div class="form-row">
              <div class="form-group col-md-3">
                <label for="precioPublico">Precio Publico</label>
                <input type="number" class="form-control" id="precioPublico" name="precioPublico" disabled> 
              </div>
              <div class="form-group col-md-3">
                <label for="costo">Costo</label>
                <input type="number" class="form-control" id="costo" name="costo" disabled>
              </div>
              <div class="form-group col-md-3">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" id="cantidad" min=1 name="cantidad">
              </div>
              <div class="form-group col-md-3">
                <label for="total">Total</label>
                <input type="number" class="form-control" id="total" name="total" disabled>
              </div>
            </div>
          </div>
          <button type="button" class="btn btn-primary" title="Buscar Producto" id="pBuscar"><i class="fas fa-search" style="color: white;"></i></button>
          <button type="button" class="btn btn-success" title="Agregar al Carrito" id="pAgregar"><i class="fas fa-shopping-cart" style="color: white;"></i></button>
        </form>
        <div class="table-responsive">
          <table id="tabla-lista" class="table table-striped table-bordered" style="width: 100%;">
            <thead>
              <tr id="table-header">
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Total</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="agregar">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>