<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<?php $this->load->view('Ventas/modalAgregar'); ?>
<?php $this->load->view('Ventas/modalEditar'); ?>
<?php $this->load->view('Ventas/modalDetalle'); ?>
<?php $this->load->view('Ventas/modalProductos'); ?>

<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Ventas</h1>
      <button type="button" class="btn boton agregar" data-toggle="modal" data-target="#exampleModalCenter" id="btnAgregar">
        Agregar
      </button>
    </div>
    
    <div id="filtroo">
      <label for="filtro">Mostrar:</label>
      <select class="form-control" id="filtro">
        <option value="">Todos</option>
        <option value="1">Vendidos</option>
        <option value="0">Devueltos</option>
      </select>
    </div>
        
    <div class="table-responsive">
      <table id="tabla" class="table table-striped table-bordered">
        <thead>
          <tr id="table-header">
            <th scope="col">Vendedor</th>
            <th scope="col">Subtotal</th>
            <th scope="col">Fecha - Hora</th>
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
  var listaProductos = [];
  var fecha = fechaActual();

  $(document).ready(function() {
    $("#fecha").val(fecha);
    obtenerVentas();
    $("#filtro").on('change', function() {
      var valor = $(this).val();
      if(valor === "") {
        obtenerVentas();
      } else {
        $.ajax({
          url: "<?php echo base_url(); ?>Ventas/filtrarVentas",
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
                    data.posts[i].status = "Vendido";
                  } else {
                    data.posts[i].status = "Devuelto";
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
  function obtenerVentas() {
    $.ajax({
      url: "<?php echo base_url(); ?>Ventas/obtenerVentas",
      type: "POST",
      dataType: "json",
      success: function(data) {
        
        for (var i = 0; i < data.posts.length; i++) {
          if (data.posts[i].status == 1) {
            data.posts[i].status = "Vendido";
          } else {
            data.posts[i].status = "Devuelto";
          }
        }
        $('#tabla').DataTable().destroy();
        inicializarTabla(data);
      }
    });
  }

  //INICIALIZA LA TABLA DE VENTAS
  function inicializarTabla(data) {
    // console.log(data);
    $('#tabla').DataTable({
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
        {"render": function(data, type, row, meta) {
          return `${row.nombres} ${row.apellidoP} ${row.apellidoM}`;
        }},
        {"render": function(data, type, row, meta) {
          return `$${row.subtotal}`;
        }},
        {"data": "fecha"},
        {"data": "status"},
        {"render": function(data, type, row, meta) {
          var a = '';
          if(row.status == 'Devuelto') {
            a = `<i class="fas fa-toggle-off" value="${row.idVentas}" id="activar" title="Activar"></i> <i class="fas fa-pencil-alt" value="${row.idVentas}" id="editar" title="Editar"></i> <i class="fas fa-info" value="${row.idVentas}" id="detalle" title="Detalles"></i>`;
          } else {
            a = `<i class="fas fa-toggle-on" value="${row.idVentas}" id="desactivar" title="Desactivar"></i> <i class="fas fa-pencil-alt" value="${row.idVentas}" id="editar" title="Editar"></i> <i class="fas fa-info" value="${row.idVentas}" id="detalle" title="Detalles"></i>`;
          }
          
          return a;
        }}
      ]
    });
  }

  // INICIALIZA LA TABLA DE PRODUCTOS (BUSQUEDA)
  function inicializarTablaProductos(data) {
    $('#tabla-productos').DataTable({
      language: {
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No se encontraron resultados",
        info:
          "",
        infoEmpty: "",
        infoFiltered: "",
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
      "data" : data.posts,
      "columns": [
        {"data": "nombreProducto"},
        {"data": "tipo"},
        {"data": "marca"},
        {"render": function(data, type, row, meta) {
          return `$${row.costo}`;
        }},
        {"data": "existencia"},
        {"render": function(data, type, row, meta) {
          return `<i class="fas fa-plus" value="${row.idProductos}" id="producto" title="Agregar" style="color: green; cursor: pointer;"></i>`;
        }}
      ]
    });
  }

  // INICIALIZA LA TABLA DE LISTA
  function inicializarTablaLista(data) {
    $('#tabla-lista').DataTable({
      language: {
        lengthMenu: "Mostrar _MENU_ registros",
        zeroRecords: "No hay productos en la lista",
        info:
          "",
        infoEmpty: "",
        infoFiltered: "",
        sSearch: "Buscar:",
        oPaginate: {
          sFirst: "Primero",
          sLast: "Último",
          sNext: "Siguiente",
          sPrevious: "Anterior",
        },
        sProcessing: "Procesando...",
      },
      lengthMenu: [3, 20, 50, 100],
      scrollY: 150,
      scroller: true,
      "data" : data,
      "columns": [
        {"data": "nombre"},
        {"render": function(data, type, row, meta) {
          return `$${row.precio}`;
        }},
        {"data": "cantidad"},
        {"render": function(data, type, row, meta) {
          return `$${row.total}`;
        }},
        {"render": function(data, type, row, meta) {
          return `<i class="fas fa-trash-alt" value="${row.idProducto}" id="pEliminar" title="Eliminar" style="color: red; cursor: pointer;"></i>`;
        }}
      ]
    });
  }

  // DETECTA CUANDO SE CIERRA UN MODAL
  $("#modalProductos").on('hidden.bs.modal', function () {
    $('#tabla-productos').DataTable().destroy();
    $('#exampleModalCenter').show();
  });

  // TOMA DATOS DE LOS PRODUCTOS
  $(document).on("click", "#producto", function(e) {
    e.preventDefault();
    var idProducto = $(this).attr("value");
    $.ajax({
      url: "<?php echo base_url()?>Ventas/obtenerProductoId",
      type: "POST",
      dataType: "json",
      data: {
        idProducto: idProducto
      },
      success: function(data) {
        // console.log(data.post);
        var precioPublico = parseInt(data.post.precioPublico);
        $("#modalProductos").modal('hide');
        $("#precioPublico").val(precioPublico);
        $('#costo').val(data.post.costo);
        $('#nombreProducto').val(data.post.nombreProducto);
        $('#idProducto').val(data.post.idProductos);
        $('#existencia').val(data.post.existencia);
        $('#cantidad').val("");
        $('#total').val("");
        $('#exampleModalCenter').show();
      }
    });
  });  

  $("#cantidad").keyup(function(){
    var cantidad = $("#cantidad").val();
    var precioPublico = $("#precioPublico").val();
    var total = precioPublico * cantidad;
    $("#total").val(total);
  });
  
  $("#cantidad").change(function(){
		var cantidad = $("#cantidad").val();
    var precioPublico = $("#precioPublico").val();
    var total = precioPublico * cantidad;
    $("#total").val(total);
	});

  //BUSCAR PRODUCTOS
  $(document).on("click", "#pBuscar", function(e) {
      $.ajax({
        url: "<?php echo base_url(); ?>Ventas/obtenerProductosActivos",
        type: "POST",
        dataType: "json",
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#modalProductos').modal('show');
            $('#exampleModalCenter').hide();
            inicializarTablaProductos(data);
          } else {
            toastr["error"](data.mensaje);
          }
        }
      });
  });

  //AGREGAR A LISTA DE VENTA
  $(document).on("click", "#pAgregar", function(e) {
    e.preventDefault();
    if($("#cantidad").val() > $("#existencia").val()) {
      toastr["error"]("No hay suficiente en existencia!");
    } else if($("#cantidad").val() === "") {
      toastr["error"]("Ingrese una cantidad!");
    }else {
      var datos = {
        nombre: $("#nombreProducto").val(),
        precio: $("#precioPublico").val(),
        cantidad: $("#cantidad").val(),
        total: $("#total").val(),
        idProducto: $("#idProducto").val(),
      }
      var existencia = $("#existencia").val();
      var cantidad = $("#cantidad").val();
      existencia -= cantidad;
      $("#existencia").val(existencia);
      listaProductos.push(datos);
      $('#tabla-lista').DataTable().destroy();
      inicializarTablaLista(listaProductos);
    }
  });

  //ELIMINAR PRODUCTO DE LA LISTA
  $(document).on("click", "#pEliminar", function(e) {
    var idProducto = $(this).attr("value");
      
    for (var i = 0; i < listaProductos.length; i++){
      if (listaProductos[i].idProducto === idProducto) {
          listaProductos.splice(i,1);
      }
    }
    $('#tabla-lista').DataTable().clear().rows.add(listaProductos).draw();
  });

  $(document).on("click", "#btnAgregar", function(e) {
    $('#tabla-lista').DataTable().destroy();
    inicializarTablaLista(listaProductos);
  });

  // AGREGAR
  $(document).on("click", "#agregar", function(e) {
    e.preventDefault();
    var nombreProducto = $("#nombreProducto").val();
    var idEmpleado = <?php echo $this->session->userdata('s_idEmpleado');?>;
    var precioPublico = $("#precioPublico").val();
    var costo = $("#costo").val();
    var cantidad = $("#cantidad").val();
    var total = $("#total").val();
    var clienteNombre = $("#clienteNombre").val();
    var clienteApellidoP = $("#clienteApellidoP").val();
    var clienteApellidoM = $("#clienteApellidoM").val();
    var clienteContacto = $("#clienteContacto").val();
    
    if(listaProductos.length === 0) {
      toastr["error"]("No hay productos registrados!");
    } else if(clienteNombre === "" || clienteApellidoP === "" || clienteApellidoM === "" || clienteContacto === "") {
      toastr["error"]("Completar todos los campos");
    } else {
      var subtotal = 0;
      for (var i = 0; i < listaProductos.length; i++){
        subtotal += parseInt(listaProductos[i].total);
      }
      $.ajax({
        url: "<?php echo base_url(); ?>Ventas/agregar",
        type: "POST",
        dataType: "json",
        data: {
          subtotal: subtotal,
          idEmpleados: idEmpleado,
          clienteNombre: clienteNombre,
          clienteApellidoP: clienteApellidoP,
          clienteApellidoM: clienteApellidoM,
          clienteContacto: clienteContacto
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            toastr["success"](data.mensaje);
            var idVenta = data.post.idVenta;
            var lista = listaProductos;
            $.ajax({
              url: "<?php echo base_url(); ?>Ventas/agregarDetalleVentas",
              type: "POST",
              dataType: "json",
              data: {
                idVenta: idVenta,
                lista: lista,
              },
              success: function(data) {
                console.log('DESPUES DE AGREGAR');
                console.log(listaProductos);
                listaProductos = [];
                console.log(listaProductos);
              }
            });
            $('#tabla').DataTable().destroy();
            // $('#tabla-lista').DataTable().destroy();
            obtenerVentas();
            $("#exampleModalCenter").modal('hide');
            document.getElementById("FormAgregar").reset();
            $("#fecha").val(fecha);

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
    var idVenta = $(this).attr("value");
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
          url: "<?php echo base_url()?>Ventas/cambiarStatus",
          type: "POST",
          dataType: "json",
          data: {
            idVenta: idVenta,
            status: status
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerVentas();
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
    var idVenta = $(this).attr("value");
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
          url: "<?php echo base_url()?>Ventas/cambiarStatus",
          type: "POST",
          dataType: "json",
          data: {
            idVenta: idVenta,
            status: status
          },
          success: function(data) {
            $('#tabla').DataTable().destroy();
            obtenerVentas();
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
    var idEmpleado = $(this).attr("value");
    $.ajax({
      url: "<?php echo base_url()?>Colaboradores/modificar",
      type: "POST",
      dataType: "json",
      data: {
        idEmpleado: idEmpleado
      },
      success: function(data) {
        // $('#tabla').DataTable().destroy();
        // obtenerEmpleados();
        // console.log(data);
        $('#modalEditar').modal('show');
        $('#e_id').val(data.post.idEmpleados);
        $('#e_nombre').val(data.post.nombres);
        $('#e_apellidoP').val(data.post.apellidoP);
        $('#e_apellidoM').val(data.post.apellidoM);
        $('#e_correo').val(data.post.correo);
        $(`#e_puesto > option[value=${data.post.idPuestos}]`).attr("selected",true);
      }
    });
  });

  // EDITAR - ACTUALIZAR
  $(document).on("click", "#actualizar", function(e) {
    e.preventDefault();

    var idEmpleados = $('#e_id').val();
    var nombres = $('#e_nombre').val();
    var apellidoP = $('#e_apellidoP').val();
    var apellidoM = $('#e_apellidoM').val();
    var correo = $('#e_correo').val();
    var puesto = $("#e_puesto").val();

    if(nombres === "" || apellidoP === "" || apellidoM === "" || correo === "" || puesto == 0) {
      toastr["error"]("Completar todos los campos");
    } else {
      $.ajax({
        url: "<?php echo base_url()?>Colaboradores/actualizar",
        type: "POST",
        dataType: "json",
        data: {
          idEmpleados: idEmpleados,
          nombres: nombres,
          apellidoP: apellidoP,
          apellidoM: apellidoM,
          correo: correo,
          idPuestos: puesto
        },
        success: function(data) {
          if(data.respuesta == 'exito') {
            $('#tabla').DataTable().destroy();
            obtenerEmpleados();
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
    var idVenta = $(this).attr("value");
    // console.log(`Id: ${idEmpleado}`);

    $.ajax({
      url: "<?php echo base_url()?>Ventas/detalle",
      type: "POST",
      dataType: "json",
      data: {
        idVenta: idVenta
      },
      success: function(data) {
        $('#d_comprador').html(`<b>Comprador:</b> ${data.post[0].clienteNombre} ${data.post[0].clienteApellidoP} ${data.post[0].clienteApellidoM}`);
        $('#d_contacto').html(`<b>Contacto:</b> ${data.post[0].clienteContacto}`);
        $('#d_fecha').html(`<b>Fecha y hora:</b> ${data.post[0].fecha}`);
        var html = '';
        var total = 0;
        for (var i = 0; i < data.post.length; i++) {
          html += `<tr>
                    <td>${data.post[i].cantidad}</td>
                    <td>${data.post[i].nombreProducto}</td>
                    <td class="text-right">$${data.post[i].precioPublico}</td>
                    <td class="text-right">$${parseInt(data.post[i].precioPublico) * parseInt(data.post[i].cantidad)}</td>
                  </tr>`;
          total = parseInt(data.post[i].subtotal);
        }
        html += `<tr>
										<td colspan="3" style="text-align: right;">Total.</td>
										<td style="text-align: right;">$${total}</td>
									</tr>`;
        $('#tabla-contenido').html(html);
        $('#modalDetalle').modal('show');
        
      }
    });
  });

  function fechaActual() {
    var fecha = new Date();
    var mes = fecha.getMonth()+1;
    var dia = fecha.getDate(); 
    var ano = fecha.getFullYear();
    if(dia<10)
      dia='0'+dia;
    if(mes<10)
      mes='0'+mes
    return `${ano}-${mes}-${dia}` 
  }

  function imprimir(){
    var ficha = document.getElementById('factura');
	  var ventimp = window.open(' ', 'popimpr');
	  ventimp.document.write( ficha.innerHTML );
	  ventimp.document.close();
	  ventimp.print( );
	  ventimp.close();
  }

</script>