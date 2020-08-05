<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Egreso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="number" class="form-control" id="e_id" name="e_id" style="display: none">
                <label for="d_serie">Serie</label>
                <input type="number" class="form-control" id="e_serie" name="e_serie" >
              </div>
              <div class="form-group col-md-6">
                <label for="d_folio">Folio</label>
                <input type="number" class="form-control" id="e_folio" name="e_folio" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="d_subtotal">Subtotal</label>
                <input type="number" class="form-control" id="e_subtotal" name="e_subtotal" >
              </div>
              <div class="form-group col-md-6">
                <label for="d_fecha">Fecha</label>
                <input type="date" class="form-control" id="e_fecha" name="e_fecha" >
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="d_proveedor">Proveedor</label>
                <select class="form-control" id="e_proveedor" name="e_proveedor" >
                  <option value="0">Seleccione un proveedor</option>
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
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
        <button type="button" class="btn btn-success" id="actualizar">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>