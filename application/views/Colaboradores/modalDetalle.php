<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Detalle Colaborador</h5>
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
                <label for="d_nombre">Nombre(s)</label>
                <input type="text" class="form-control" id="d_nombre" name="d_nombre" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="d_apellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" id="d_apellidoP" name="d_apellidoP" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="d_apellidoM">Apellido Materno</label>
                <input type="text" class="form-control" id="d_apellidoM" name="d_apellidoM" disabled>
              </div>
              <div class="form-group col-md-6">
                <label for="d_correo">Correo Electronico</label>
                <input type="email" class="form-control" id="d_correo" name="d_correo" disabled>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="d_puesto">Puesto</label>
                <select class="form-control" id="d_puesto" name="d_puesto" disabled>
                  <option value="0">Seleccione un puesto</option>
                  <option value="1">Administrador</option>
                </select>
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