<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle Egreso</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="number" class="form-control" id="d_id" name="d_id" style="display: none">
                <label for="d_serie">Serie</label>
                <input type="number" class="form-control" id="d_serie" name="d_serie" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="d_folio">Folio</label>
                <input type="number" class="form-control" id="d_folio" name="d_folio" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="d_subtotal">Subtotal</label>
                <input type="text" class="form-control" id="d_subtotal" name="d_subtotal" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="d_fecha">Fecha</label>
                <input type="date" class="form-control" id="d_fecha" name="d_fecha" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="d_proveedor">Proveedor</label>
                <select class="form-control" id="d_proveedor" name="d_proveedor" disabled>
                  <option value="0">Seleccione un proveedor</option>
                  <?php foreach ($proveedores as $proveedor) {
                    echo '<option value="'.$proveedor->idProveedores.'">'.$proveedor->razonSocial.'</option>';
                  } ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="d_fechaCreacion">Creado el</label>
                <input type="text" class="form-control" id="d_fechaCreacion" name="d_fechaCreacion" disabled>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Salir</button>
      </div>
    </div>
  </div>
</div>