<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Puesto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombrePuesto">Nombre Puesto</label>
                <input type="text" class="form-control" id="nombrePuesto" name="nombrePuesto" >
              </div>
              <div class="form-group col-md-6">
                <label for="entrada">Entrada</label>
                <input type="time" class="form-control" id="entrada" name="entrada" value="08:00">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="salida">Salida</label>
                <input type="time" class="form-control" id="salida" name="salida" value="17:00">
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