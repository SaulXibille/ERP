<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header" style="background-color: #91c9e8">
            <h5 class="modal-title" id="exampleModalLongTitle">Modificar Producto</h5>
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
                            <label for="d_nombreProducto">Nombre</label>
                            <input type="text" class="form-control" id="d_nombreProducto" name="d_nombreProducto" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d_costo">Costo</label>
                            <input type="number" class="form-control" id="d_costo" name="d_costo" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="d_precioPublico">Precio al Público</label>
                            <input type="number" class="form-control" id="d_precioPublico" name="d_precioPublico" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d_proveedor">Proveedor</label>
                            <select class="form-control" id="d_proveedor" name="d_proveedor" disabled>
                                <option selected value="0">Seleccione un proveedor</option>
                                <option value="1">Xibusinness</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="d_numSerie">Número de Serie</label>
                            <input type="text" class="form-control" id="d_numSerie" name="d_numSerie" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d_marca">Marca</label>
                            <input type="text" class="form-control" id="d_marca" name="d_marca" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="d_modelo">Modelo</label>
                            <input type="text" class="form-control" id="d_modelo" name="d_modelo" disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="d_tipo">Tipo</label>
                            <input type="text" class="form-control" id="d_tipo" name="d_tipo" disabled>
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