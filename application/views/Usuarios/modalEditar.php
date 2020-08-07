<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Modificar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
        <div class="form-group">
            <div class="form-row">
              <input type="number" class="form-control" id="e_id" name="e_id" style="display: none">
              <div class="form-group col-md-12">
                <label for="e_correo">Correo Electronico</label>
                <input type="email" class="form-control" id="e_correo" name="e_correo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="e_contra">Contraseña</label>
                <input type="password" class="form-control" id="e_contra" name="e_contra" data-info="">
              </div>
              <div class="form-group col-md-6">
                <label for="e_conf_contra">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="e_conf_contra" name="e_conf_contra" data-info="">
              </div>
              <div class="form-group col-md-4">
                <label for="e_colaborador">Colaborador</label>
                <select class="form-control" id="e_colaborador" name="e_colaborador">
                  <option selected value="0">Seleccione un colaborador</option>
                  <?php foreach ($colaboradores as $colaborador) {
                    echo '<option value="'.$colaborador->idEmpleados.'">'.$colaborador->nombres.'</option>';
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