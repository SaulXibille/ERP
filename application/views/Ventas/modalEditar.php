<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Colaborador</h5>
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
                <label for="e_nombre">Nombre(s)</label>
                <input type="text" class="form-control" id="e_nombre" name="e_nombre">
              </div>
              <div class="form-group col-md-6">
                <label for="e_apellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" id="e_apellidoP" name="e_apellidoP">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="e_apellidoM">Apellido Materno</label>
                <input type="text" class="form-control" id="e_apellidoM" name="e_apellidoM">
              </div>
              <div class="form-group col-md-6">
                <label for="e_correo">Correo Electronico</label>
                <input type="email" class="form-control" id="e_correo" name="e_correo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="e_puesto">Puesto</label>
                <select class="form-control" id="e_puesto" name="e_puesto">
                  <option value="0">Seleccione un puesto</option>
                  <?php foreach ($puestos as $puesto) {
                    echo '<option value="'.$puesto->idPuestos.'">'.$puesto->nombrePuesto.'</option>';
                  } ?>
                </select>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="actualizar">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>