<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<?php $this->load->view('Usuarios/modalAgregar'); ?>
<?php $this->load->view('Usuarios/modalEditar'); ?>
<?php $this->load->view('Usuarios/modalDetalle'); ?>

<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Usuarios</h1>
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
            <th scope="col">Correo</th>
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
  function obtenerUsuarios() {
    $.ajax({
      url: "<?php echo base_url(); ?>Usuarios/obtenerUsuarios",
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
            {"data": "correo"},
            {"data": "status"},
            {"render": function(data, type, row, meta) {
              var a = `<i class="fas fa-pencil-alt" value="${row.idUsuarios}" id="editar" title="Editar"></i> <i class="fas fa-trash-alt" value="${row.idUsuarios}" id="eliminar" title="Eliminar"></i> <i class="fas fa-info" value="${row.idUsuarios}" id="detalle" title="Detalles"></i>`;
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
    var correo = $("#correo").val();
    var colaborador = $("#colaborador").val();
    var contraseña = $("#contra").val();
    var conf_contraseña = $("#conf_contra").val();

    if(correo === "" || colaborador == 0 || contraseña === "" || conf_contraseña === "") {
      toastr["error"]("Completar todos los campos");
    } else if(contraseña != conf_contraseña) {
      toastr["error"]("La contraseña no coinciden");
    }else {
      $.ajax({
        url: "<?php echo base_url(); ?>Usuarios/agregar",
        type: "POST",
        dataType: "json",
        data: {
          correo: correo,
          contraseña: contraseña,
          idEmpleados: colaborador
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerUsuarios();
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
    var idUsuario = $(this).attr("value");

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
          url: "<?php echo base_url()?>Usuarios/eliminar",
          type: "POST",
          dataType: "json",
          data: {
            idUsuario: idUsuario
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerUsuarios();
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
    var idUsuario = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Usuarios/modificar",
      type: "POST",
      dataType: "json",
      data: {
        idUsuario: idUsuario
      },
      success: function(data) {
        // $('#tabla').DataTable().destroy();
        // obtenerEmpleados();
        console.log(data);
        $('#modalEditar').modal('show');
        $('#e_id').val(data.post.idUsuarios);
        $('#e_correo').val(data.post.correo);
        $('#e_contra').val(data.post.contraseña);
        $('#e_conf_contra').val(data.post.contraseña);
        $(`#e_colaborador > option[value=${data.post.idEmpleados}]`).attr("selected",true);
      }
    });
  });

  // EDITAR - ACTUALIZAR
  $(document).on("click", "#actualizar", function(e) {
    e.preventDefault();

    var idUsuario = $('#e_id').val();
    var correo = $("#e_correo").val();
    var colaborador = $("#e_colaborador").val();
    var contraseña = $("#e_contra").val();
    var conf_contraseña = $("#e_conf_contra").val();

    if(correo === "" || colaborador == 0 || contraseña === "" || conf_contraseña === "") {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url()?>Usuarios/actualizar",
        type: "POST",
        dataType: "json",
        data: {
          correo: correo,
          contraseña: contraseña,
          idEmpleados: colaborador,
          idUsuarios: idUsuario
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerUsuarios();
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
    var idUsuario = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Usuarios/detalle",
      type: "POST",
      dataType: "json",
      data: {
        idUsuario: idUsuario
      },
      success: function(data) {
        // $('#tabla').DataTable().destroy();
        // obtenerEmpleados();
        // console.log(data);
        $('#modalDetalle').modal('show');
        $('#d_id').val(data.post.idUsuarios);
        $('#d_correo').val(data.post.correo);
        $('#d_contra').val(data.post.contraseña);
        $('#d_conf_contra').val(data.post.contraseña);
        $(`#d_colaborador > option[value=${data.post.idEmpleados}]`).attr("selected",true);
      }
    });
  });

  obtenerUsuarios();
</script>