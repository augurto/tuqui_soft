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
                    <select id="coordinador-select" class="select2" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <?php
                        $query = "SELECT id, nombre FROM usuarios WHERE rol != 3";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button id="agregar-coordinador" type="button">Agregar coordinador</button>
                <table id="coordinadores-table" style="margin-top: 10px;">
                    <thead>
                        <tr>
                            <th>Coordinadores</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="form-group">
                <label>Asignar redactor</label>
                <div class="select2-purple">
                    <select id="redactor-select" class="select2" data-placeholder="Select a State" data-dropdown-css-class="select2-purple" style="width: 100%;">
                        <?php
                        $query = "SELECT id, nombre FROM usuarios WHERE rol != 3";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <button id="agregar-redactor" type="button">Agregar redactor</button>
                <table id="redactores-table" style="margin-top: 10px;">
                    <thead>
                        <tr>
                            <th>Redactores</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
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
        $(document).ready(function() {

            // Agregar coordinador
            $("#agregar-coordinador").click(function() {
                var coordinadorId = $("#coordinador-select").val();
                var coordinadorNombre = $("#coordinador-select option:selected").text();

                // Verificar si ya se ha agregado este coordinador
                if ($("#coordinadores-table tbody tr[data-id='" + coordinadorId + "']").length > 0) {
                    alert("Este coordinador ya ha sido agregado");
                    return;
                }

                // Agregar el coordinador a la tabla
                var row = "<tr data-id='" + coordinadorId + "'>";
                row += "<td>" + coordinadorNombre + "</td>";
                row += "<td><button type='button' class='btn btn-sm btn-danger eliminar-coordinador'>Eliminar</button></td>";
                row += "</tr>";
                $("#coordinadores-table tbody").append(row);
            });

            // Eliminar coordinador
            $("#coordinadores-table tbody").on("click", ".eliminar-coordinador", function() {
                $(this).closest("tr").remove();
            });

            // Agregar redactor
            $("#agregar-redactor").click(function() {
                var redactorId = $("#redactor-select").val();
                var redactorNombre = $("#redactor-select option:selected").text();

                // Verificar si ya se ha agregado este redactor
                if ($("#redactores-table tbody tr[data-id='" + redactorId + "']").length > 0) {
                    alert("Este redactor ya ha sido agregado");
                    return;
                }

                // Agregar el redactor a la tabla
                var row = "<tr data-id='" + redactorId + "'>";
                row += "<td>" + redactorNombre + "</td>";
                row += "<td><button type='button' class='btn btn-sm btn-danger eliminar-redactor'>Eliminar</button></td>";
                row += "</tr>";
                $("#redactores-table tbody").append(row);
            });

            // Eliminar redactor
            $("#redactores-table tbody").on("click", ".eliminar-redactor", function() {
                $(this).closest("tr").remove();
            });

        });
    </script>

