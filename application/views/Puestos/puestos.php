<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<?php $this->load->view('Puestos/modalAgregar'); ?>
<?php $this->load->view('Puestos/modalEditar'); ?>
<?php $this->load->view('Puestos/modalDetalle'); ?>

<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Puestos</h1>
      <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter">
        Agregar
      </button>
    </div>

    <div id="filtroo">
      <label for="filtro">Mostrar:</label>
      <select class="form-control" id="filtro">
        <option value="">Todos</option>
        <option value="1">Activos</option>
        <option value="0">Inactivos</option>
      </select>
    </div>

    <div class="table-responsive">
      <table id="tabla" class="table table-striped table-bordered">
        <thead>
          <tr id="table-header">
            <th scope="col">Puesto</th>
            <th scope="col">Entrada</th>
            <th scope="col">Salida</th>
            <th scope="col">Estado</th>
            <th scope="col">Acción</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<?php $this->load->view('template/footer'); ?>

<script>

// FILTRAR
$(document).ready(function() {
    obtenerPuestos();
    $("#filtro").on('change', function() {
      var valor = $(this).val();
      if(valor === "") {
        obtenerPuestos();
      } else {
        $.ajax({
          url: "<?php echo base_url(); ?>Puestos/filtrarPuestos",
          type: "POST",
          dataType: "json",
          data: {
            status: valor
          },
          success: function(data) {
            if(data.respuesta == 'error') {
              toastr["error"]("No hay registros para mostrar");
            } else {
              for (var i = 0; i < data.posts.length; i++) {
                if (data.posts[i].status == 1) {
                  data.posts[i].status = "Activo";
                } else {
                  data.posts[i].status = "Inactivo";
                }
              }
              $('#tabla').DataTable().destroy();
              inicializarTabla(data);
            }
          }
        });
      }
    });
  });

  // CONSULTA - MOSTRAR EN LA TABLA
  function obtenerPuestos() {
    $.ajax({
      url: "<?php echo base_url(); ?>Puestos/obtenerPuestos",
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

        $('#tabla').DataTable().destroy();
        inicializarTabla(data);

      }
    });
  }

  function inicializarTabla(data) {
    $('#tabla').DataTable({
      // responsive: true,
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
      lengthMenu: [10, 20, 50, 100],
      scrollY: 400,
      scroller: true,
      dom: "<'row' <'col-sm-12 col-md-4'l> <'col-sm-12 col-md-4 excel'B> <'col-sm-12 col-md-4'f> >" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
      buttons: [
        {
          extend: 'excelHtml5',
          text: '<i class="fas fa-file-excel"></i>',
          titleAttr: 'Exportar a Excel',
          className: 'btn btn-success'
        },
      ],
      "data" : data.posts,
      "columns": [
        {"data": "nombrePuesto"},
        {"data": "entrada"},
        {"data": "salida"},
        {"data": "status"},
        {"render": function(data, type, row, meta) {
          var a = '';
          if(row.status == 'Inactivo') {
            a = `<i class="fas fa-toggle-off" value="${row.idPuestos}" id="activar" title="Activar"></i> <i class="fas fa-pencil-alt" value="${row.idPuestos}" id="editar" title="Editar"></i> <i class="fas fa-info" value="${row.idPuestos}" id="detalle" title="Detalles"></i>`;
          } else {
            a = `<i class="fas fa-toggle-on" value="${row.idPuestos}" id="desactivar" title="Desactivar"></i> <i class="fas fa-pencil-alt" value="${row.idPuestos}" id="editar" title="Editar"></i> <i class="fas fa-info" value="${row.idPuestos}" id="detalle" title="Detalles"></i>`;
          }
          return a;
        }}
      ]
    });
  }

  // AGREGAR
  $(document).on("click", "#agregar", function(e) {
    e.preventDefault();
    var nombrePuesto = $("#nombrePuesto").val();
    var entrada = $("#entrada").val();
    var salida = $("#salida").val();

    if(nombrePuesto === "" || entrada === "" || salida === "") {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Puestos/agregar",
        type: "POST",
        dataType: "json",
        data: {
          nombrePuesto: nombrePuesto,
          entrada: entrada,
          salida: salida,
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerPuestos();
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

  // DESACTIVAR
  $(document).on("click", "#desactivar", function(e) {
    e.preventDefault();
    var idPuesto = $(this).attr("value");
    var status = $(this).attr("id");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: '¿Seguro que quieres desactivarlo?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, desactivarlo!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        $.ajax({
          url: "<?php echo base_url()?>Puestos/cambiarStatus",
          type: "POST",
          dataType: "json",
          data: {
            idPuesto: idPuesto,
            status: status
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerPuestos();
            if(data.respuesta == "exito") {
              swalWithBootstrapButtons.fire(
                'Desactivado!',
                'Registro desactivado correctamente!',
                'success'
              )
            } else {
              swalWithBootstrapButtons.fire(
                'Cancelado!',
                'No se desactivo el registro!',
                'error'
              )
            }
          }
        });
        
      } else if (
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelado!',
          'No se desactivo el registro!',
          'error'
        )
      }
    });
  });

  //ACTIVAR 
  $(document).on("click", "#activar", function(e) {
    e.preventDefault();
    var idPuesto = $(this).attr("value");
    var status = $(this).attr("id");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: '¿Seguro que quieres activarlo?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, activarlo!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        $.ajax({
          url: "<?php echo base_url()?>Puestos/cambiarStatus",
          type: "POST",
          dataType: "json",
          data: {
            idPuesto: idPuesto,
            status: status
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerPuestos();
            if(data.respuesta == "exito") {
              swalWithBootstrapButtons.fire(
                'Activado!',
                'Registro activado correctamente!',
                'success'
              )
            } else {
              swalWithBootstrapButtons.fire(
                'Cancelado!',
                'No se activo el registro!',
                'error'
              )
            }
          }
        });
        
      } else if (
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelado!',
          'No se activo el registro!',
          'error'
        )
      }
    });
  });

  // EDITAR
  $(document).on("click", "#editar", function(e) {
    e.preventDefault();
    var idPuesto = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Puestos/modificar",
      type: "POST",
      dataType: "json",
      data: {
        idPuesto: idPuesto
      },
      success: function(data) {
        $('#modalEditar').modal('show');
        $('#e_id').val(data.post.idPuestos);
        $('#e_nombrePuesto').val(data.post.nombrePuesto);
        $('#e_entrada').val(data.post.entrada);
        $('#e_salida').val(data.post.salida);
      }
    });
  });

  // EDITAR - ACTUALIZAR
  $(document).on("click", "#actualizar", function(e) {
    e.preventDefault();

    var idPuestos = $('#e_id').val();
    var nombrePuesto = $("#e_nombrePuesto").val();
    var entrada = $("#e_entrada").val();
    var salida = $("#e_salida").val();

    if(nombrePuesto === "" || entrada === "" || salida === "") {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url()?>Puestos/actualizar",
        type: "POST",
        dataType: "json",
        data: {
          idPuestos: idPuestos,
          nombrePuesto: nombrePuesto,
          entrada: entrada,
          salida: salida
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerPuestos();
            $("#modalEditar").modal('hide');
            toastr["success"](data.mensaje);
          } else {
            toastr["error"](data.mensaje);
          }
        }
      }); 
    }
  });

  // CONSULTAR - DETALLE
  $(document).on("click", "#detalle", function(e) {
    e.preventDefault();
    var idPuesto = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Puestos/detalle",
      type: "POST",
      dataType: "json",
      data: {
        idPuesto: idPuesto
      },
      success: function(data) {
        $('#modalDetalle').modal('show');
        $('#d_id').val(data.post.idPuestos);
        $('#d_nombrePuesto').val(data.post.nombrePuesto);
        $('#d_entrada').val(data.post.entrada);
        $('#d_salida').val(data.post.salida);
      }
    });
  });
</script>