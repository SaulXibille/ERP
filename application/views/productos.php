<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombreProducto">Nombre</label>
                <input type="text" class="form-control" id="nombreProducto" name="nombreProducto">
              </div>
              <div class="form-group col-md-6">
                <label for="costo">Costo</label>
                <input type="text" class="form-control" id="costo" name="costo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="precioPublico">Precio al Público</label>
                <input type="text" class="form-control" id="precioPublico" name="precioPublico">
              </div>
              <div class="form-group col-md-6">
                <label for="numSerie">Número de Serie</label>
                <input type="text" class="form-control" id="numSerie" name="numSerie">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputState">Puesto</label>
                <select id="inputState" class="form-control">
                  <option selected>Seleccione un proveedor</option>
                  <option>...</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo">
              </div>
              <div class="form-group col-md-6">
                <label for="tipo">Tipo</label>
                <input type="text" class="form-control" id="tipo" name="tipo">
              </div>
            </div>  
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn boton" id="agregar">Guardar Cambios</button>
      </div>
    </div>
  </div>
</div>

<div class="container">

  <div class="info">
    <h1 class="title">Productos</h1>
    <!-- <button class="btn agregar">Agregar</button> -->
    <!-- Abrir modal Agregar -->
    <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter">
      Agregar
    </button>
  </div>

  <table id="example" class="table table-striped">
    <thead>
      <tr id="table-header">
        <th scope="col">Nombre</th>
        <th scope="col">Marca</th>
        <th scope="col">Costo</th>
        <th scope="col">Precio al Público</th>
        <th scope="col">Estado</th>
        <th scope="col">Acción</th>
      </tr>
    </thead>
    <tbody id="contenidoTabla">
      <tr>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td class="acciones"><i class="fas fa-pencil-alt"></i> <i class="fas fa-trash-alt"></i> <i class="fas fa-info"></i></td>
      </tr>
    </tbody>
  </table>

</div>

<?php $this->load->view('template/footer'); ?>

<script>
  $(document).on("click", "#agregar", function(e) {
    productos.preventDefault();
    var nomProducto = $("#nomProducto").val();
    var costo = $("#costo").val();
    var precioPublico = $("#precioPublico").val();
    var numSerie = $("#numSerie").val();
    var marca = $("#marca").val();
    var modelo = $("#modelo").val();
    var tipo = $("#tipo").val();

  });
</script>