<?php $this->load->view('template/header'); ?>
<?php $this->load->view('template/menu'); ?>

<div class="padre">
  <div class="hijo">
    <div class="row">
    <!-- GRAFICA DE PRODUCTOS -->
      <div class="col-lg-6" style="margin-top: 74px;">
        <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <div class="card-header" style="background-color: #91c9e8">
            <div class="d-flex">
              <h3 class="card-title">Mejores Productos</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <!-- <span class="text-bold text-lg">$18,230.00</span>
                <span>Sales Over Time</span> -->
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <!-- <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 33.1%
                </span> -->
                <span class="text-muted">Productos mas vendidos.</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="productos-chart" height="280"></canvas>
            </div>
          </div>
        </div>
      </div>

    <!-- GRAFICA DE INGRESOS-EGRESOS -->
      <div class="col-lg-6" style="margin-top: 74px;">
        <div class="card" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
          <div class="card-header" style="background-color: #91c9e8">
            <div class="d-flex">
              <h3 class="card-title">Ingresos - Egresos</h3>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex">
              <p class="d-flex flex-column">
                <!-- <span class="text-bold text-lg">$18,230.00</span>
                <span>Sales Over Time</span> -->
              </p>
              <p class="ml-auto d-flex flex-column text-right">
                <!-- <span class="text-success">
                  <i class="fas fa-arrow-up"></i> 33.1%
                </span> -->
                <span class="text-muted">Diferencia entre ingresos y egresos.</span>
              </p>
            </div>
            <!-- /.d-flex -->

            <div class="position-relative mb-4">
              <canvas id="ingresos-chart" height="280"></canvas>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->load->view('template/footer'); ?>

<script>

function graficaProductos(data) {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var {
    posts
  } = data;


  var mode      = 'index'
  var intersect = true

  var $productosChart = $('#productos-chart')
  var productosChart  = new Chart($productosChart, {
    type   : 'bar',
    data   : {
      labels  : posts.map(item => item.nombreProducto),
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : posts.map(item => item.TotalVentas)
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
}

function GraficaIngEgr(data) {
  // console.log(data);
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode      = 'index'
  var intersect = true

  var $ingresosChart = $('#ingresos-chart')
  var ingresosChart  = new Chart($ingresosChart, {
    type   : 'bar',
    data   : {
      labels  : data.map(item => item.titulo),
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor    : '#007bff',
          data           : data.map(item => item.total)
        }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips           : {
        mode     : mode,
        intersect: intersect
      },
      hover              : {
        mode     : mode,
        intersect: intersect
      },
      legend             : {
        display: false
      },
      scales             : {
        yAxes: [{
          // display: false,
          gridLines: {
            display      : true,
            lineWidth    : '4px',
            color        : 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks    : $.extend({
            beginAtZero: true,
            callback: function (value, index, values) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }
              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display  : true,
          gridLines: {
            display: false
          },
          ticks    : ticksStyle
        }]
      }
    }
  })
}
  

// CONSULTA - MOSTRAR EN LA TABLA
function productosMasVendidos() {
  $.ajax({
    url: "<?php echo base_url(); ?>Productos/productosMasVendidos",
    type: "POST",
    dataType: "json",
    success: function(data) {
      graficaProductos(data);
    }
  });
}

// CONSULTA - EGRESOS Y INGRESOS
function ingresos_egresos() {
  var datos= [];
  $.ajax({
    url: "<?php echo base_url(); ?>Ingresos/ingresos_egresos",
    type: "POST",
    dataType: "json",
    success: function(data) {
      // graficaProductos(data);
      // console.log(data);
      
      for (var i = 0; i < data.post.length; i++) {
        if(i == 0) {
          var info = {
            titulo: "Ingresos",
            total: data.post[i].total
          }
          datos.push(info);
        } else {
          var info = {
            titulo: "Egresos",
            total: data.post[i].total
          }
          datos.push(info);
        }
      }

      GraficaIngEgr(datos);
      
    }
  });
}

productosMasVendidos();
ingresos_egresos();
</script>
