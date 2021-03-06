<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle Puesto</h5>
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
                <label for="d_nombrePuesto">Nombre Puesto</label>
                <input type="text" class="form-control" id="d_nombrePuesto" name="d_nombrePuesto" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="d_entrada">Entrada</label>
                <input type="time" class="form-control" id="d_entrada" name="d_entrada" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="d_salida">Salida</label>
                <input type="time" class="form-control" id="d_salida" name="d_salida" disabled>
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