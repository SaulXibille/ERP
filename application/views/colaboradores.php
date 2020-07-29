<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Agregar Colaboradores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" id="FormAgregar">
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="nombre">Nombre(s)</label>
                <input type="text" class="form-control" id="nombre" name="nombre">
              </div>
              <div class="form-group col-md-6">
                <label for="apellidoP">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellidoP" name="apellidoP">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="apellidoM">Apellido Materno</label>
                <input type="text" class="form-control" id="apellidoM" name="apellidoM">
              </div>
              <div class="form-group col-md-6">
                <label for="correo">Correo Electronico</label>
                <input type="email" class="form-control" id="correo" name="correo">
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="form-group col-md-4">
                <label for="puesto">Puesto</label>
                <select class="form-control" id="puesto" name="puesto">
                  <option selected value="0">Seleccione un puesto</option>
                  <option value="1">Administrador</option>
                </select>
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
    <h1 class="title">Colaboradores</h1>
    <!-- <button class="btn agregar">Agregar</button> -->
    <!-- Abrir modal Agregar -->
    <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter">
      Agregar
    </button>
  </div>

  <table id="tablaColaboradores" class="table table-striped">
    <thead>
      <tr id="table-header">
        <th scope="col">Nombre(s)</th>
        <th scope="col">A. Paterno</th>
        <th scope="col">A. Materno</th>
        <th scope="col">Puesto</th>
        <th scope="col">Estado</th>
        <th scope="col">Acción</th>
      </tr>
    </thead>
    <tbody id="contenidoTabla">
      <!-- <tr>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td>Ejemplo</td>
        <td class="acciones"><i class="fas fa-pencil-alt"></i> <i class="fas fa-trash-alt"></i> <i class="fas fa-info"></i></td>
      </tr> -->
    </tbody>
  </table>

</div>

<?php $this->load->view('template/footer'); ?>

<script>

  // CONSULTA - MOSTRAR EN LA TABLA
  function obtenerEmpleados() {
    $.ajax({
      url: "<?php echo base_url(); ?>Colaboradores/obtenerEmpleados",
      type: "POST",
      dataType: "json",
      success: function(data) {
        
        for (var i = 0; i < data.posts.length; i++) {
          if (data.posts[i].status == 1) {
            data.posts[i].status = "Activo";
          } else {
            data.posts[i].status = "Inactivo";
          }
        }

        $('#tablaColaboradores').DataTable().destroy();
        $('#tablaColaboradores').DataTable({
          language: {
            lengthMenu: "Mostrar _MENU_ registros",
            zeroRecords: "No se encontraron resultados",
            info:
              "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            oPaginate: {
              sFirst: "Primero",
              sLast: "Último",
              sNext: "Siguiente",
              sPrevious: "Anterior",
            },
            sProcessing: "Procesando...",
          },
          "data" : data.posts,
          "columns": [
            {"data": "nombres"},
            {"data": "apellidoP"},
            {"data": "apellidoM"},
            {"data": "nombrePuesto"},
            {"data": "status"},
            {"render": function(data, type, row, meta) {
              var a = `<i class="fas fa-pencil-alt"></i> <i class="fas fa-trash-alt"></i> <i class="fas fa-info"></i>`;
              return a;
            }}
          ]
        });

      }
    });
  }

  // AGREGAR
  $(document).on("click", "#agregar", function(e) {
    e.preventDefault();
    var nombres = $("#nombre").val();
    var apellidoP = $("#apellidoP").val();
    var apellidoM = $("#apellidoM").val();
    var correo = $("#correo").val();
    var puesto = $("#puesto").val();

    if(nombres === "" || apellidoP === "" || apellidoM === "" || correo === "" || puesto == 0) {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Colaboradores/agregar",
        type: "POST",
        dataType: "json",
        data: {
          nombres: nombres,
          apellidoP: apellidoP,
          apellidoM: apellidoM,
          correo: correo,
          idPuestos: puesto
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tablaColaboradores').DataTable().destroy();
            obtenerEmpleados();
            $("#exampleModalCenter").modal('hide');
            toastr["success"](data.mensaje);
          } else {
            toastr["error"](data.mensaje);
          }
        }
      });
      document.getElementById("FormAgregar").reset();
    }
  });

  obtenerEmpleados();
</script>