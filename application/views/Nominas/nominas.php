<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<?php $this->load->view('Nominas/modalAgregar'); ?>
<?php $this->load->view('Nominas/modalEditar'); ?>
<?php $this->load->view('Nominas/modalDetalle'); ?>

<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Nominas</h1>
      <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter">
        Agregar
      </button>
    </div>
    <div class="table-responsive">
      <table id="tabla" class="table table-striped table-bordered">
        <thead>
          <tr id="table-header">
            <th scope="col">Nombre(s)</th>
            <th scope="col">A. Paterno</th>
            <th scope="col">A. Materno</th>
            <th scope="col">Sueldo</th>
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

    // CONSULTA - MOSTRAR EN LA TABLA
  function obtenerNominas() {
    $.ajax({
      url: "<?php echo base_url(); ?>Nominas/obtenerNominas",
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
            {"data": "nombres"},
            {"data": "apellidoP"},
            {"data": "apellidoM"},
            {"data": "sueldo"},
            {"data": "status"},
            {"render": function(data, type, row, meta) {
              var a = `<i class="fas fa-pencil-alt" value="${row.idNominas}" id="editar" title="Editar"></i> <i class="fas fa-trash-alt" value="${row.idNominas}" id="eliminar" title="Eliminar"></i> <i class="fas fa-info" value="${row.idNominas}" id="detalle" title="Detalles"></i>`;
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
    var empleado = $("#empleado").val();
    var sueldo = $("#sueldo").val();
    var imss = $("#imss").val();
    var pension = $("#pension").val();

    if(empleado == 0 || sueldo == 0 || imss == 0 || pension == 0) {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Nominas/agregar",
        type: "POST",
        dataType: "json",
        data: {
          idEmpleados: empleado,
          sueldo: sueldo,
          imss: imss,
          pension: pension
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerNominas();
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

  // ELIMINAR
  $(document).on("click", "#eliminar", function(e) {
    e.preventDefault();
    var idNomina = $(this).attr("value");

    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger mr-2'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: '¿Seguro que quieres eliminarlo?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Si, eliminarlo!',
      cancelButtonText: 'No, cancelar!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        $.ajax({
          url: "<?php echo base_url()?>Nominas/eliminar",
          type: "POST",
          dataType: "json",
          data: {
            idNomina: idNomina
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerNominas();
            if(data.respuesta == "exito") {
              swalWithBootstrapButtons.fire(
                'Eliminado!',
                'Registro eliminado correctamente!',
                'success'
              )
            } else {
              swalWithBootstrapButtons.fire(
                'Cancelado!',
                'No se elimino el registro!',
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
          'No se elimino el registro!',
          'error'
        )
      }
    });
  });

  // EDITAR
  $(document).on("click", "#editar", function(e) {
    e.preventDefault();
    var idNomina = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Nominas/modificar",
      type: "POST",
      dataType: "json",
      data: {
        idNomina: idNomina
      },
      success: function(data) {
        // $('#tabla').DataTable().destroy();
        // obtenerEmpleados();
        console.log(data);
        $('#modalEditar').modal('show');
        $('#e_id').val(data.post.idNominas);
        $('#e_sueldo').val(data.post.sueldo);
        $('#e_imss').val(data.post.imss);
        $('#e_pension').val(data.post.pension);
        $(`#e_empleado > option[value=${data.post.idEmpleados}]`).attr("selected",true);
      }
    });
  });

  // EDITAR - ACTUALIZAR
  $(document).on("click", "#actualizar", function(e) {
    e.preventDefault();

    var idNominas = $('#e_id').val();
    console.log(idNominas);
    var sueldo = $('#e_sueldo').val();
    console.log(sueldo);
    var imss = $('#e_imss').val();
    var pension = $('#e_pension').val();
    var empleado = $("#e_empleado").val();

    if(empleado == 0 || sueldo == 0 || imss == 0 || pension == 0) {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url()?>Nominas/actualizar",
        type: "POST",
        dataType: "json",
        data: {
          idNominas: idNominas,
          sueldo: sueldo,
          imss: imss,
          pension: pension,
          idEmpleados: empleado
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerNominas();
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
    var idNomina = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Nominas/detalle",
      type: "POST",
      dataType: "json",
      data: {
        idNomina: idNomina
      },
      success: function(data) {
        // $('#tabla').DataTable().destroy();
        // obtenerEmpleados();
        console.log(data);
        $('#modalDetalle').modal('show');
        $('#d_id').val(data.post.idNominas);
        $('#d_sueldo').val(data.post.sueldo);
        $('#d_imss').val(data.post.imss);
        $('#d_pension').val(data.post.pension);
        $(`#d_empleado > option[value=${data.post.idEmpleados}]`).attr("selected",true);
      }
    });
  });

  obtenerNominas();
</script>