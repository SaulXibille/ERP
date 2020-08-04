<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <label for="empleado">Empleado</label>
                        <select class="form-control" id="empleado" name="empleado">
                        <option selected value="0">Seleccione un empleado</option>
                        <?php foreach ($empleados as $empleado) {
                            echo '<option value="'.$empleado->idEmpleados.'">'.$empleado->nombres.' '.$empleado->apellidoP.' '.$empleado->apellidoM.'</option>';
                        } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="sueldo">Sueldo</label>
                        <input type="number" class="form-control" id="sueldo" name="sueldo">
                    </div>
                </div>
            </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="imss">NSS</label>
                <input type="number" class="form-control" id="imss" name="imss">
              </div>
              <div class="form-group col-md-6">
                <label for="pension">Pension</label>
                <input type="number" class="form-control" id="pension" name="pension">
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