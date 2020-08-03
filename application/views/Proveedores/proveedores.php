<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<?php $this->load->view('Proveedores/modalAgregar'); ?>
<?php $this->load->view('Proveedores/modalEditar'); ?>
<?php $this->load->view('Proveedores/modalDetalle'); ?>

<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Proveedores</h1>
      <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter">
        Agregar
      </button>
    </div>
    <div class="table-responsive">
      <table id="tabla" class="table table-striped table-bordered">
        <thead>
          <tr id="table-header">
            <th scope="col">Razon Social</th>
            <th scope="col">RFC</th>
            <th scope="col">Giro</th>
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
  function obtenerProveedores() {
    $.ajax({
      url: "<?php echo base_url(); ?>Proveedores/obtenerProveedores",
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
            {"data": "razonSocial"},
            {"data": "rfc"},
            {"data": "giro"},
            {"data": "status"},
            {"render": function(data, type, row, meta) {
              var a = `<i class="fas fa-pencil-alt" value="${row.idProveedores}" id="editar" title="Editar"></i> <i class="fas fa-trash-alt" value="${row.idProveedores}" id="eliminar" title="Eliminar"></i> <i class="fas fa-info" value="${row.idProveedores}" id="detalle" title="Detalles"></i>`;
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
    var razonSocial = $("#razonSocial").val();
    var rfc = $("#rfc").val();
    var giro = $("#giro").val();

    if(razonSocial === "" || rfc === "" || giro === "") {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Proveedores/agregar",
        type: "POST",
        dataType: "json",
        data: {
          razonSocial: razonSocial,
          rfc: rfc,
          giro: giro
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerProveedores();
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
    var idProveedor = $(this).attr("value");

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
          url: "<?php echo base_url()?>Proveedores/eliminar",
          type: "POST",
          dataType: "json",
          data: {
            idProveedor: idProveedor
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerProveedores();
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
    var idProveedor = $(this).attr("value");
    console.log(`Id: ${idProveedor}`);

    $.ajax({
      url: "<?php echo base_url()?>Proveedores/modificar",
      type: "POST",
      dataType: "json",
      data: {
        idProveedor: idProveedor
      },
      success: function(data) {
        console.log(data);
        $('#modalEditar').modal('show');
        $('#e_id').val(data.post.idProveedores);
        $('#e_razonSocial').val(data.post.razonSocial);
        $('#e_rfc').val(data.post.rfc);
        $('#e_giro').val(data.post.giro);
      }
    });
  });

  // EDITAR - ACTUALIZAR
  $(document).on("click", "#actualizar", function(e) {
    e.preventDefault();

    var idProveedores = $('#e_id').val();
    var razonSocial = $('#e_razonSocial').val();
    var rfc = $('#e_rfc').val();
    var giro = $('#e_giro').val();

    if(razonSocial === "" || rfc === "" || giro === "") {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url()?>Proveedores/actualizar",
        type: "POST",
        dataType: "json",
        data: {
          idProveedores: idProveedores,
          razonSocial: razonSocial,
          rfc: rfc,
          giro: giro
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerProveedores();
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
    var idProveedor = $(this).attr("value");
    console.log(`Id: ${idProveedor}`);

    $.ajax({
      url: "<?php echo base_url()?>Proveedores/detalle",
      type: "POST",
      dataType: "json",
      data: {
        idProveedor: idProveedor
      },
      success: function(data) {
        console.log(data);
        $('#modalDetalle').modal('show');
        $('#d_id').val(data.post.idProveedores);
        $('#d_razonSocial').val(data.post.razonSocial);
        $('#d_rfc').val(data.post.rfc);
        $('#d_giro').val(data.post.giro);
      }
    });
  });

  obtenerProveedores();
</script>