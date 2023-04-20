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
                    <label>Asignar coordinador</label>
                    <div class="select2-purple" style="display: flex;">
                        <select id="coordinador-select" class="select2" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <?php
                            $query = "SELECT id, nombre, rol FROM usuarios WHERE rol != 3";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . ' - ' . $row['rol']; ?></option>
                        <?php } ?>
                        </select>
                        <button id="agregar-coordinador"  class="form-control" type="button" style="margin-left: 10px;">Agregar coordinador</button>
                    </div>
                </div>

                <div class="form-group">
                    <label>Asignar redactor</label>
                    <div class="select2-purple" style="display: flex;">
                        <select id="redactor-select" class="select2" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <?php
                            $query = "SELECT id, nombre, rol FROM usuarios WHERE rol != 3";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . ' - ' . $row['rol']; ?></option>
                        <?php } ?>
                        </select>
                        <button id="agregar-redactor"  class="form-control"  type="button" style="margin-left: 10px;">Agregar redactor</button>
                    </div>
                </div>


                <table class="table table-striped table-bordered" id="tabla-usuarios">
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
            $(document).ready(function() {
                // Arreglo para almacenar los usuarios asignados
                var usuariosAsignados = [];

                // Manejar el evento del botón "Agregar coordinador"
                $('#agregar-coordinador').click(function() {
                // Obtener el valor seleccionado en el select de coordinador
                var usuarioId = $('#coordinador-select').val();

                // Obtener el texto del option seleccionado
                var usuarioNombre = $('#coordinador-select option:selected').text();

                // Verificar que el usuario no haya sido asignado anteriormente
                var encontrado = false;
                for (var i = 0; i < usuariosAsignados.length; i++) {
                    if (usuariosAsignados[i].id == usuarioId) {
                    encontrado = true;
                    break;
                    }
                }

                // Si el usuario no ha sido asignado anteriormente, agregarlo a la tabla
                if (!encontrado) {
                    usuariosAsignados.push({
                    id: usuarioId,
                    nombre: usuarioNombre
                    });

                    var nuevaFila = '<tr><td>' + usuarioNombre + '</td><td><button type="button" class="btn btn-sm btn-danger btn-eliminar-usuario"><i class="fas fa-trash-alt"></i></button></td></tr>';

                    $('#tabla-usuarios tbody').append(nuevaFila);
                }
                });

                // Manejar el evento de eliminar un usuario
                $(document).on('click', '.btn-eliminar-usuario', function() {
                var rowIndex = $(this).closest('tr').index();

                usuariosAsignados.splice(rowIndex, 1);

                $(this).closest('tr').remove();
                });
            });
        </script>


