<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<?php $this->load->view('Productos/modalAgregar'); ?>
<?php $this->load->view('Productos/modalEditar'); ?>
<?php $this->load->view('Productos/modalDetalle'); ?>

<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Productos</h1>
      <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter">
        Agregar
      </button>
    </div>
    <div class="table-responsive">
      <table id="tabla" class="table table-striped table-bordered">
        <thead>
          <tr id="table-header">
            <th scope="col">Nombre</th>
            <th scope="col">Marca</th>
            <th scope="col">Costo</th>
            <th scope="col">Precio al Público</th>
            <th scope="col">SKU</th>
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
  function obtenerProductos() {
    $.ajax({
      url: "<?php echo base_url(); ?>Productos/obtenerProductos",
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
            {"data": "nombreProducto"},
            {"data": "marca"},
            {"data": "costo"},
            {"data": "precioPublico"},
            {"data": "sku"},
            {"data": "status"},
            {"render": function(data, type, row, meta) {
              var a = `<i class="fas fa-pencil-alt" value="${row.idProductos}" id="editar" title="Editar"></i> <i class="fas fa-trash-alt" value="${row.idProductos}" id="eliminar" title="Eliminar"></i> <i class="fas fa-info" value="${row.idProductos}" id="detalle" title="Detalles"></i> <i class="fas fa-plus" value="${row.idProductos}" id="mas" title="Agregar a stock"></i>`;
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
    var nombreProducto = $("#nombreProducto").val();
    var costo = $("#costo").val();
    var precioPublico = $("#precioPublico").val();
    var numSerie = $("#numSerie").val();
    var marca = $("#marca").val();
    var modelo = $("#modelo").val();
    var tipo = $("#tipo").val();
    var sku = $("#sku").val();
    var proveedor = $("#proveedor").val();

    if(nombreProducto === "" || costo == 0 || precioPublico == 0 || sku == 0 || numSerie === "" || marca === "" || modelo === "" || tipo === "" || proveedor == 0) {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Productos/agregar",
        type: "POST",
        dataType: "json",
        data: {
          nombreProducto: nombreProducto,
          costo: costo,
          precioPublico: precioPublico,
          numSerie: numSerie,
          marca: marca,
          modelo: modelo,
          tipo: tipo,
          sku: sku,
          idProveedores: proveedor
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerProductos();
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
    var idProducto = $(this).attr("value");

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
          url: "<?php echo base_url()?>Productos/eliminar",
          type: "POST",
          dataType: "json",
          data: {
            idProducto: idProducto
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerProductos();
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
    var idProducto = $(this).attr("value");
    console.log(`Id: ${idProducto}`);
    $.ajax({
      url: "<?php echo base_url()?>Productos/modificar",
      type: "POST",
      dataType: "json",
      data: {
        idProducto: idProducto
      },
      success: function(data) {
        
        $('#modalEditar').modal('show');
        $('#e_id').val(data.post.idProductos);
        $('#e_nombreProducto').val(data.post.nombreProducto);
        $('#e_costo').val(data.post.costo);
        $('#e_precioPublico').val(data.post.precioPublico);
        $(`#e_proveedor > option[value=${data.post.idProveedores}]`).attr("selected",true);
        $('#e_numSerie').val(data.post.numSerie);
        $('#e_marca').val(data.post.marca);
        $('#e_modelo').val(data.post.modelo);
        $('#e_tipo').val(data.post.tipo);
        $('#e_sku').val(data.post.sku);
        
      }
    });
  });

  // EDITAR - ACTUALIZAR
  $(document).on("click", "#actualizar", function(e) {
    e.preventDefault();

    var idProductos = $('#e_id').val();
    var nombreProducto = $('#e_nombreProducto').val();
    var costo = $('#e_costo').val();
    var precioPublico = $('#e_precioPublico').val();
    var proveedor = $("#e_proveedor").val();
    var numSerie = $('#e_numSerie').val();
    var marca = $('#e_marca').val();
    var modelo = $('#e_modelo').val();
    var tipo = $('#e_tipo').val();
    var sku = $('#e_sku').val();
    console.log(sku);
    if(nombreProducto === "" || costo == 0 || precioPublico == 0 || proveedor == 0 || sku == 0 || numSerie === "" || marca === "" || modelo === "" || tipo === "") {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url()?>Productos/actualizar",
        type: "POST",
        dataType: "json",
        data: {
          idProductos: idProductos,
          nombreProducto: nombreProducto,
          costo: costo,
          precioPublico: precioPublico,
          numSerie: numSerie,
          marca: marca,
          modelo: modelo,
          tipo: tipo,
          sku: sku,
          idProveedores: proveedor
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerProductos();
            $("#modalEditar").modal('hide');
            toastr["success"](data.mensaje);
          } else {
            toastr["error"](data.mensaje);
          }
        }
      }); 
    }
  });

  // CONSULTAR - DETALLE CAMBIAR NOMBRE DEL BOTON!!
  $(document).on("click", "#detalle", function(e) {
    e.preventDefault();
    var idProducto = $(this).attr("value");

    $.ajax({
      url: "<?php echo base_url()?>Productos/detalle",
      type: "POST",
      dataType: "json",
      data: {
        idProducto: idProducto
      },
      success: function(data) {
        console.log(data);
        $('#modalDetalle').modal('show');
        $('#d_id').val(data.post.idProductos);
        $('#d_nombreProducto').val(data.post.nombreProducto);
        $('#d_costo').val(data.post.costo);
        $('#d_precioPublico').val(data.post.precioPublico);
        $('#d_numSerie').val(data.post.numSerie);
        $('#d_marca').val(data.post.marca);
        $('#d_modelo').val(data.post.modelo);
        $('#d_tipo').val(data.post.tipo);
        $('#d_sku').val(data.post.sku);
        $(`#d_proveedor > option[value=${data.post.idProveedores}]`).attr("selected",true);
      }
    });
  });

  obtenerProductos();
</script>