<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Nomina</h5>
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
                        <label for="e_empleado">Empleado</label>
                        <select class="form-control" id="e_empleado" name="e_empleado">
                        <option selected value="0">Seleccione un empleado</option>
                        <?php foreach ($empleados as $empleado) {
                            echo '<option value="'.$empleado->idEmpleados.'">'.$empleado->nombres.' '.$empleado->apellidoP.' '.$empleado->apellidoM.'</option>';
                        } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="e_sueldo">Sueldo</label>
                        <input type="number" class="form-control" id="e_sueldo" name="e_sueldo">
                    </div>
                </div>
            </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="e_imss">NSS</label>
                <input type="number" class="form-control" id="e_imss" name="e_imss">
              </div>
              <div class="form-group col-md-6">
                <label for="e_pension">Pension</label>
                <input type="number" class="form-control" id="e_pension" name="e_pension">
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