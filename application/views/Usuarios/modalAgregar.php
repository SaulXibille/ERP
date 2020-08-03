<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-12">
                <label for="correo">Correo Electronico</label>
                <input type="email" class="form-control" id="correo" name="correo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="contra">Contraseña</label>
                <input type="password" class="form-control" id="contra" name="contra">
              </div>
              <div class="form-group col-md-6">
                <label for="conf_contra">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="conf_contra" name="conf_contra">
              </div>
              <div class="form-group col-md-4">
                <label for="colaborador">Colaborador</label>
                <select class="form-control" id="colaborador" name="colaborador">
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
        <button type="button" class="btn btn-success" id="agregar">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>