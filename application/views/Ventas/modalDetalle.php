<!-- Modal -->
<div class="modal fade" id="modalDetalle" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
		aria-hidden="true">
		<div class="modal-dialog modal-lg" role="document">
			<div class="modal-content">
				<div class="modal-header" style="background-color: #91c9e8">
					<h5 class="modal-title" id="exampleModalLabel">Detalle Venta</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="container" style="width: 85%; padding: 5px" id="factura">
							<!-- <div class="col-md-6">
								<h1>
									<a href=" "><img alt="" src="image/logo.png" /> Unity 3D
									</a>
								</h1>
							</div> -->

							<h3 style="text-align: center;">FACTURA</h3>
              
							<div class="row">
								<div class="col">
									<div class="card">
										<div class="card-header" style="background-color: #eee" id="d_fecha">
												
										</div>
										<div class="card-body">
                      <div class="row">
                        <div class="col" id="d_comprador">
                        
                        </div>
                        <div class="col text-right" id="d_contacto">
                          
                        </div>
                      </div>
										</div>
									</div>
								</div>
							</div>

							<table class="table table-bordered mt-2" id="d_tabla">
								<thead>
									<tr>
										<th>Cantidad</th>
										<th>Producto</th>
										<th>Precio unitario</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody id="tabla-contenido">

								</tbody>
							</table>

              <div class="card mb-2" style="text-align: center;">
                <div class="card-body" style="font-size: 13px;">
                  Gracias por utilizar nuestros servicios!
                </div>
              </div>
					</div>
				</div>
				<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="javascript:imprimir()">
				<i class="fas fa-print mr-2"></i>Imprimir
					</button>
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Salir
					</button>
				</div>
			</div>
		</div>
	</div>