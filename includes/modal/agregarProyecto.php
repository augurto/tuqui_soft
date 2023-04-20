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
                <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <?php
                            $query = "SELECT id, nombre, rol FROM usuarios WHERE rol = 1 OR rol = 2";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . ' - ' . $row['rol']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Asignar redactor</label>
                <div class="select2-purple">
                    <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <?php
                            $query = "SELECT id, nombre, rol FROM usuarios WHERE rol = 2 OR rol = 0";
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre'] . ' - ' . $row['rol']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>


                <!-- /.form-group -->
              
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
            var usuariosAsignados = []; // Registro de usuarios asignados
            var coordinadorSelect = document.getElementById("coordinador-select");
            var redactorSelect = document.getElementById("redactor-select");
            var agregarCoordinadorBtn = document.getElementById("agregar-coordinador");
            var agregarRedactorBtn = document.getElementById("agregar-redactor");

            agregarCoordinadorBtn.onclick = function() {
                agregarUsuario("coordinador-select");
            };

            agregarRedactorBtn.onclick = function() {
                agregarUsuario("redactor-select");
            };

            function agregarUsuario(selectId) {
                var select = document.getElementById(selectId);
                var usuarioSeleccionado = select.options[select.selectedIndex].value;

                // Verificar si el usuario ya ha sido asignado como coordinador o redactor
                if (usuariosAsignados.includes(usuarioSeleccionado)) {
                    alert("Este usuario ya ha sido asignado como coordinador o redactor.");
                    return;
                }

                // Agregar el usuario seleccionado a la lista correspondiente
                var option = document.createElement("option");
                option.value = usuarioSeleccionado;
                option.text = usuarioSeleccionado;
                select.add(option);

                // Agregar el usuario seleccionado al registro de usuarios asignados
                usuariosAsignados.push(usuarioSeleccionado);
            }
        </script>
