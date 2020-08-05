<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Egreso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="serie">Serie</label>
                <input type="number" class="form-control" id="serie" name="serie">
              </div>
              <div class="form-group col-md-6">
                <label for="folio">Folio</label>
                <input type="number" class="form-control" id="folio" name="folio">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="subtotal">Subtotal</label>
                <input type="number" class="form-control" id="subtotal" name="subtotal">
              </div>
              <div class="form-group col-md-6">
                <label for="fecha">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="proveedor">Proveedor</label>
                <select class="form-control" id="proveedor" name="proveedor">
                  <option selected value="0">Seleccione un proveedor</option>
                  <?php foreach ($proveedores as $proveedor) {
                    echo '<option value="'.$proveedor->idProveedores.'">'.$proveedor->razonSocial.'</option>';
                  } ?>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="agregar">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>