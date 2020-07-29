<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Proveedores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="razonSocial">Razon Social</label>
                        <input type="text" class="form-control" id="razonSocial" name="razonSocial">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="rfc">RFC</label>
                        <input type="text" class="form-control" id="rfc" name="rfc">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="giro">Giro</label>
                        <input type="text" class="form-control" id="giro" name="giro">
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
    <h1 class="title">Proveedores</h1>
    <!-- <button class="btn agregar">Agregar</button> -->
    <!-- Abrir modal Agregar -->
    <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter">
      Agregar
    </button>
  </div>

  <table id="example" class="table table-striped">
    <thead>
      <tr id="table-header">
        <th scope="col">Razon Social</th>
        <th scope="col">RFC</th>
        <th scope="col">Giro</th>
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
        <td class="acciones"><i class="fas fa-pencil-alt"></i> <i class="fas fa-trash-alt"></i> <i class="fas fa-info"></i></td>
      </tr>
    </tbody>
  </table>

</div>

<?php $this->load->view('template/footer'); ?>

<script>
  $(document).on("click", "#agregar", function(proveedores) {
    proveedores.preventDefault();
    var razonSocial = $("#razonSocial").val();
    var rfc = $("#rfc").val();
    var giro = $("#giro").val();

  });
</script>