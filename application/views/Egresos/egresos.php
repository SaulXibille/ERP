<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<?php $this->load->view('Egresos/modalAgregar'); ?>
<?php $this->load->view('Egresos/modalDetalle'); ?>
<?php $this->load->view('Egresos/modalEditar'); ?>

<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Egresos</h1>
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
            <th scope="col">Serie</th>
            <th scope="col">Folio</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Fecha</th>
            <th scope="col">Proveedor</th>
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

$(document).ready(function() {
  obtenerEgresos();
  $("#filtro").on('change', function() {
    var valor = $(this).val();
    if(valor === "") {
      obtenerEgresos();
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Egresos/filtrarEgresos",
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
   function obtenerEgresos() {
    $.ajax({
      url: "<?php echo base_url(); ?>Egresos/obtenerEgresos",
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
        {"data": "serie"},
        {"data": "folio"},
        {"render": function(data, type, row, meta) {
          return `$${row.subtotal}`;
        }},
        {"data": "fecha"},
        {"data": "razonSocial"},
        {"data": "status"},
        {"render": function(data, type, row, meta) {
          var a = '';
          if(row.status == 'Inactivo') {
            a = `<i class="fas fa-toggle-off" value="${row.id_Egresos}" id="activar" title="Activar"></i> <i class="fas fa-pencil-alt" value="${row.id_Egresos}" id="editar" title="Editar"></i> <i class="fas fa-info" value="${row.id_Egresos}" id="detalle" title="Detalles"></i>`;
          } else {
            a = `<i class="fas fa-toggle-on" value="${row.id_Egresos}" id="desactivar" title="Desactivar"></i> <i class="fas fa-pencil-alt" value="${row.id_Egresos}" id="editar" title="Editar"></i> <i class="fas fa-info" value="${row.id_Egresos}" id="detalle" title="Detalles"></i>`;
          }
          
          return a;
        }}
      ]
    });
  }

   // AGREGAR
   $(document).on("click", "#agregar", function(e) {
    e.preventDefault();
    var serie = $("#serie").val();
    var folio = $("#folio").val();
    var subtotal = $("#subtotal").val();
    var fecha = $("#fecha").val();
    var proveedor = $("#proveedor").val();

    if(serie === "" || folio === "" || subtotal === "" || fecha === "" || proveedor == 0) {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Egresos/agregar",
        type: "POST",
        dataType: "json",
        data: {
          serie: serie,
          folio: folio,
          subtotal: subtotal,
          fecha: fecha,
          idProveedores: proveedor
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerEgresos();
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

   // CONSULTAR - DETALLE
   $(document).on("click", "#detalle", function(e) {
    e.preventDefault();
    var idEgresos = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Egresos/detalle",
      type: "POST",
      dataType: "json",
      data: {
        id_Egresos: idEgresos
      },
      success: function(data) {
        // $('#tabla').DataTable().destroy();
        // obtenerEmpleados();
        console.log(data);
        $('#modalDetalle').modal('show');
        $('#d_id').val(data.post.id_Egresos);
        $('#d_serie').val(data.post.serie);
        $('#d_folio').val(data.post.folio);
        $('#d_subtotal').val("$"+data.post.subtotal);
        $('#d_fecha').val(data.post.fecha);
        $(`#d_proveedor > option[value=${data.post.idProveedores}]`).attr("selected",true);
        $('#d_fechaCreacion').val(data.post.createdAt);
      }
    });
  });

  // EDITAR
  $(document).on("click", "#editar", function(e) {
    e.preventDefault();
    var idEgresos = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Egresos/detalle",
      type: "POST",
      dataType: "json",
      data: {
        id_Egresos: idEgresos
      },
      success: function(data) {
        // $('#tabla').DataTable().destroy();
        // obtenerEmpleados();
        console.log(data);
        $('#modalEditar').modal('show');
        $('#e_id').val(data.post.id_Egresos);
        $('#e_serie').val(data.post.serie);
        $('#e_folio').val(data.post.folio);
        $('#e_subtotal').val(data.post.subtotal);
        $('#e_fecha').val(data.post.fecha);
        $(`#e_proveedor > option[value=${data.post.idProveedores}]`).attr("selected",true);
      }
    });     
  });

  // EDITAR - ACTUALIZAR
  $(document).on("click", "#actualizar", function(e) {
    e.preventDefault();

    var idEgresos = $('#e_id').val();
    var serie = $('#e_serie').val();
    var folio = $('#e_folio').val();
    var subtotal = $('#e_subtotal').val();
    var fecha = $('#e_fecha').val();
    var idProveedor = $("#e_proveedor").val();

    if(serie === "" || folio === "" || subtotal === "" || fecha === "" || idProveedor == 0) {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url()?>Egresos/actualizar",
        type: "POST",
        dataType: "json",
        data: {
          id_Egresos: idEgresos,
          serie: serie,
          folio: folio,
          subtotal: subtotal,
          fecha: fecha,
          idProveedores: idProveedor
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerEgresos();
            $("#modalEditar").modal('hide');
            toastr["success"](data.mensaje);
          } else {
            toastr["error"](data.mensaje);
          }
        }
      }); 
    }
  });


  // DESACTIVAR
  $(document).on("click", "#desactivar", function(e) {
    e.preventDefault();
    var idEgreso = $(this).attr("value");
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
          url: "<?php echo base_url()?>Egresos/cambiarStatus",
          type: "POST",
          dataType: "json",
          data: {
            id_Egresos: idEgreso,
            status: status
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerEgresos();
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
    var idEgreso = $(this).attr("value");
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
          url: "<?php echo base_url()?>Egresos/cambiarStatus",
          type: "POST",
          dataType: "json",
          data: {
            id_Egresos: idEgreso,
            status: status
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerEgresos();
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
</script>