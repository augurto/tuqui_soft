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
        // inicializar arrays para guardar los valores de los select
        let coordinadores = [];
        let redactores = [];

        // obtener elementos del DOM
        const selectCoordinador = document.getElementById("coordinador-select");
        const selectRedactor = document.getElementById("redactor-select");
        const btnAgregarCoordinador = document.getElementById("agregar-coordinador");
        const btnAgregarRedactor = document.getElementById("agregar-redactor");

        // función para agregar valor al array y actualizar el select
        function agregarValor(select, array) {
        const valor = select.value;
        if (valor !== "") {
            array.push(valor);
            select.value = "";
            actualizarSelect(select, array);
        }
        }

        // función para actualizar el contenido del select
        function actualizarSelect(select, array) {
        // eliminar todos los options del select
        select.innerHTML = "";
        // agregar un option por cada valor en el array
        array.forEach((valor) => {
            const option = document.createElement("option");
            option.value = valor;
            option.textContent = valor;
            select.appendChild(option);
        });
        }

        // evento para agregar coordinador
        btnAgregarCoordinador.addEventListener("click", () => {
        agregarValor(selectCoordinador, coordinadores);
        });

        // evento para agregar redactor
        btnAgregarRedactor.addEventListener("click", () => {
        agregarValor(selectRedactor, redactores);
        });

        // evento para eliminar coordinador
        selectCoordinador.addEventListener("dblclick", () => {
        const valor = selectCoordinador.value;
        const index = coordinadores.indexOf(valor);
        if (index !== -1) {
            coordinadores.splice(index, 1);
            actualizarSelect(selectCoordinador, coordinadores);
        }
        });

        // evento para eliminar redactor
        selectRedactor.addEventListener("dblclick", () => {
        const valor = selectRedactor.value;
        const index = redactores.indexOf(valor);
        if (index !== -1) {
            redactores.splice(index, 1);
            actualizarSelect(selectRedactor, redactores);
        }
        });

    </script>

