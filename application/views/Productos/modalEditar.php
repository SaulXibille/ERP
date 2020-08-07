<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                        <input type="number" class="form-control" id="e_id" name="e_id" style="display: none">
                            <label for="e_nombreProducto">Nombre</label>
                            <input type="text" class="form-control" id="e_nombreProducto" name="e_nombreProducto">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="e_costo">Costo</label>
                            <input type="number" class="form-control" id="e_costo" name="e_costo">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="e_precioPublico">Precio al Público</label>
                            <input type="number" class="form-control" id="e_precioPublico" name="e_precioPublico">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="e_proveedor">Proveedor</label>
                            <select class="form-control" id="e_proveedor" name="e_proveedor">
                                <option selected value="0">Seleccione un proveedor</option>
                                <?php foreach ($proveedores as $proveedor) {
                                    echo '<option value="'.$proveedor->idProveedores.'">'.$proveedor->razonSocial.'</option>';
                                } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="e_numSerie">Número de Serie</label>
                            <input type="text" class="form-control" id="e_numSerie" name="e_numSerie">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="e_marca">Marca</label>
                            <input type="text" class="form-control" id="e_marca" name="e_marca">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="e_modelo">Modelo</label>
                            <input type="text" class="form-control" id="e_modelo" name="e_modelo">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="e_tipo">Tipo</label>
                            <input type="text" class="form-control" id="e_tipo" name="e_tipo">
                        </div>
                    </div>  
                </div>
                <div class="form-group">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="e_sku">SKU</label>
                            <input type="text" class="form-control" id="e_sku" name="e_sku">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="e_existencia">Existencia</label>
                            <input type="text" class="form-control" id="e_existencia" name="e_existencia">
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