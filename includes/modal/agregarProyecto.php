<div class="modal fade" id="modal-agregar-proyecto">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Proyecto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <!-- NOMBRE DEL PROYECTO -->
                <div class="form-group">
                    <label>Nombre del proyecto</label>
                    <input type="text" class="form-control" placeholder="Ingrese el nombre del proyecto">
                </div>

                <!-- SELECCIONAR CLIENTE  -->
                <div class="form-group">
                <label>Cliente</label>
                <select class="form-control select2" style="width: 100%;">
                    <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
                    <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
                    <?php } ?>
                </select>
                </div>
                <!-- FIN CLIENTE -->
            
              <!-- ASIGNAR USUARIOS AL PROYECTO -->
              <div class="form-group">
                <label>Asignar asesor</label>
                <div class="select2-purple" style="display: flex;">
                    <select id="asesor-select" class="select2" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <?php
                            $query = "SELECT id, nombre, rol FROM usuarios WHERE rol != 3";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                        <?php } ?>
                    </select>
                    <button id="agregar-asesor" class="form-control" type="button" style="margin-left: 10px;">Agregar asesor</button>
                </div>
            </div>

            <table id="tabla-asesores" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

                
              
              <!-- FIN USUARIOS AL PROYECTO -->

              <!-- FECHA DE ENTREGA -->
                <div class="form-group">
                <label>Inicio y Fin de entrega</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                    </div>
                    <input type="text" class="form-control float-right" id="reservation">
                </div>
                </div>

                <!-- MONTO -->
                <div class="form-group">
                <label>Monto</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                    </div>
                    <input type="text" class="form-control">
                </div>
                </div>
                <!-- FIN MONTO -->
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              <button type="button" class="btn btn-primary">Guardar</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- INICIO DE SCRIPT -->
   <script>
    // Seleccionamos el botón y el select
    const agregarAsesorBtn = document.getElementById('agregar-asesor');
    const asesorSelect = document.getElementById('asesor-select');

    // Seleccionamos la tabla donde vamos a agregar los asesores
    const tablaAsesores = document.getElementById('tabla-asesores');

    // Agregamos un listener al botón
    agregarAsesorBtn.addEventListener('click', function() {
    // Obtenemos el valor del select
    const asesorId = asesorSelect.value;
    const asesorNombre = asesorSelect.options[asesorSelect.selectedIndex].text;

    // Creamos una nueva fila en la tabla con el nombre del asesor y un botón para eliminarlo
    const nuevaFila = document.createElement('tr');
    nuevaFila.innerHTML = `
        <td>${asesorNombre}</td>
        <td><button class="btn btn-danger btn-sm eliminar-asesor">Eliminar</button></td>
    `;

    // Agregamos la nueva fila a la tabla
    tablaAsesores.querySelector('tbody').appendChild(nuevaFila);

    // Agregamos un listener al botón de eliminar para eliminar la fila correspondiente
    const eliminarAsesorBtn = nuevaFila.querySelector('.eliminar-asesor');
    eliminarAsesorBtn.addEventListener('click', function() {
        nuevaFila.remove();
    });
    });

   </script>
