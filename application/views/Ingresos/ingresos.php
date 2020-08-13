<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>


<?php $this->load->view('Ingresos/modalDetalle'); ?>


<div class="padre">
  <div class="hijo">
    <div class="info">
      <h1 class="title">Ingresos</h1>
    </div>

    <div id="filtroo2">
      <label for="filtro">Mostrar por:</label>
      <select class="form-control" id="filtro">
        <option value="">Día</option>
        <option value="1">Mes</option>  
      </select>
    </div>

    <div class="table-responsive">
      <table id="tabla" class="table table-striped table-bordered">
        <thead>
          <tr id="table-header">
            <th scope="col">Fecha</th>
            <th scope="col">Subtotal</th>
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
  obtenerIngresos();
  $("#filtro").on('change', function() {
    var valor = $(this).val();
    if(valor === "") {
      obtenerIngresos();
    } else {
      $.ajax({
        url: "<?php echo base_url(); ?>Ingresos/filtrarIngresos",
        type: "POST",
        dataType: "json",
        success: function(data) {
            if(data.respuesta == 'error') {
              toastr["error"]("No hay registros para mostrar");
            } else {
              $('#tabla').DataTable().destroy();
              inicializarTabla(data);
            }
          }
      });
    }
  });
});

   // CONSULTA - MOSTRAR EN LA TABLA
   function obtenerIngresos() {
    $.ajax({
      url: "<?php echo base_url(); ?>Ingresos/obtenerIngresos",
      type: "POST",
      dataType: "json",
      success: function(data) {
        
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
        {"data": "fecha"},
         {"render": function(data, type, row, meta) {
          return `$${row.subtotal}`;
        }},
        {"render": function(data, type, row, meta) {
          var a = '';
          
            a = `<i class="fas fa-info" value="${row.fecha}" id="detalle" title="Detalles"></i>`;
          
          return a;
        }}
      ]
    });
  }

   // CONSULTAR - DETALLE
   $(document).on("click", "#detalle", function(e) {
    e.preventDefault();  
    var fecha = $(this).attr("value");
    var valor = $('#filtro').val();
    if(valor==""){
        $.ajax({
        url: "<?php echo base_url()?>Ingresos/detalle",
        type: "POST",
        dataType: "json",
        data: {
            fecha: fecha
        },
        success: function(data) {
            console.log(data);
            $('#modalDetalleVenta').modal('show');
            $('#d_fechas').val(data.post[0].fecha);
            $('#d_total').val("$"+data.post[0].subtotal);
            $('#d_ventas').val(data.post[0].num);
        }
        });
    }else{
        $.ajax({
        url: "<?php echo base_url()?>Ingresos/detalle2",
        type: "POST",
        dataType: "json",
        data: {
            fecha: fecha
        },
        success: function(data) {
            console.log(data);
            $('#modalDetalleVenta').modal('show');
            $('#d_fechas').val(data.post[0].fecha);
            $('#d_total').val(data.post[0].subtotal);
            $('#d_ventas').val(data.post[0].num);
        }
        });
    }

   
  });

</script>