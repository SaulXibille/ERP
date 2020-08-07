<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #91c9e8">
            <h5 class="modal-title" id="exampleModalLongTitle">Aumentar stock de producto</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="" method="POST" id="FormAgregar">
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="number" class="form-control" id="s_id" name="s_id" style="display: none">
                            <label for="s_nombreProducto">Nombre</label>
                            <input type="text" class="form-control" id="s_nombreProducto" name="s_nombreProducto" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="s_existencia">existencia</label>
                            <input type="number" class="form-control" id="s_existencia" name="s_existencia" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                    <div class="form-group col-md-6">
                            <label for="s_existenciaNueva">Cantidad a agregar</label>
                            <input type="number" class="form-control" id="s_existenciaNueva" name="s_existenciaNueva">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-success" id="actualizarStock">Guardar Cambios</button>
    </div>
    </div>
  </div>
</div>