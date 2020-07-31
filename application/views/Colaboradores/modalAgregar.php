<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Colaborador</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Nombre(s)</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
              </div>
              <div class="form-group col-md-6">
                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellidoP" name="apellidoP">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="apellidoM">Apellido Materno</label>
                <input type="text" class="form-control" id="apellidoM" name="apellidoM">
              </div>
              <div class="form-group col-md-6">
                <label for="correo">Correo Electronico</label>
                <input type="email" class="form-control" id="correo" name="correo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="puesto">Puesto</label>
                <select class="form-control" id="puesto" name="puesto">
                  <option selected value="0">Seleccione un puesto</option>
                  <option value="1">Administrador</option>
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