<!-- Modal -->
<div class="modal fade animated bounceIn" id="modalProductos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #91c9e8;">
        <h5 class="modal-title" id="exampleModalLabel">Buscar Productos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="table-responsive">
        <table id="tabla-productos" class="table table-striped table-bordered" style="width: 100%;">
          <thead>
            <tr id="table-header">
              <th scope="col">Nombre</th>
              <th scope="col">Tipo</th>
              <th scope="col">Marca</th>
              <th scope="col">Costo</th>
              <th scope="col">Existencia</th>
              <th scope="col">Acción</th>
            </tr>
          </thead>
        </table>
      </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>