<div class="modal fade" id="modal-agregar-proyecto">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Proyecto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
        <form method="POST" action="../insert/agregarProyecto.php">
            <div class="modal-body">
                <!-- NOMBRE DEL PROYECTO -->
                <div class="form-group">
                <label>Nombre del proyecto</label>
                <input id="nombre-proyecto" type="text" class="form-control" placeholder="Ingrese el nombre del proyecto">
                </div>
                <!-- SELECCIONAR CLIENTE  -->
                <div class="form-group">
                <label>Cliente</label>
                <select class="form-control select2" id="nombre_cliente" style="width: 100%;">
                    <?php while ($fila = mysqli_fetch_array($resultado)) { ?>
                    <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
                    <?php } ?>
                </select>
                </div>
                <!-- FIN CLIENTE -->
                <!-- Campo para seleccionar la universidad -->
               
                <div class="form-group">
                    <label>Universidad</label>
                    <select class="form-control select2" id="nombre_universidad" style="width: 100%;">
                        <?php
                         // consulta a la tabla universidad
                            $consulta_universidades = "SELECT * FROM universidades";
                            $resultado_universidades = mysqli_query($conn, $consulta_universidades);

                        while ($fila = mysqli_fetch_array($resultado_universidades)) { ?>
                            <option value="<?php echo $fila['id']; ?>"><?php echo $fila['departamento'].' - '.$fila['abreviatura'].' - '.$fila['nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Campo para seleccionar el tipo de proyecto -->
                <div class="form-group">
                    <label>Tipo de Proyecto</label>
                    <select class="form-control select2" id="tipo_proyecto" style="width: 100%;">
                        <?php
                        // consulta a la tabla tipo_proyecto
                        $consulta_tipo_proyecto = "SELECT * FROM tipo_proyecto";
                        $resultado_tipo_proyecto = mysqli_query($conn, $consulta_tipo_proyecto);

                        while ($fila = mysqli_fetch_array($resultado_tipo_proyecto)) { ?>
                            <option value="<?php echo $fila['id']; ?>"><?php echo $fila['nombre']; ?></option>
                        <?php } ?>
                    </select>
                </div>


            
              <!-- ASIGNAR USUARIOS AL PROYECTO -->
                <div class="form-group">
                    <label>Asignar asesor</label>
                    <div class="select2-purple" style="display: flex;">
                        <select id="asesor-select" class="select2" data-placeholder="Asignar Usuario" data-dropdown-css-class="select2-purple" style="width: 100%;">
                            <?php
                                $query = "SELECT id, nombre, rol FROM usuarios WHERE rol != 3";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <option value="<?php echo $row['id']; ?>"><?php echo $row['nombre']; ?></option>
                            <?php } ?>
                        </select>
                        <select id="rol-select" class="select2" data-placeholder="Selecciona Rol" data-dropdown-css-class="select2-purple" style="width: 100%;">
                            <option value="coordinador">Coordinador</option>
                            <option value="redactor">Redactor</option>
                        </select>
                        <button id="agregar-asesor" class="form-control" type="button" style="margin-left: 10px;">Agregar asesor</button>
                    </div>
                </div>

                <table id="tabla-asesores" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Rol</th>
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
                    <input type="text" id="monto" class="form-control">
                </div>
                </div>
                <!-- FIN MONTO -->
            </div>
     

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              
              <button type="button" class="btn btn-primary" onclick="guardarProyecto()">Guardar</button>
              


        </form>                        
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <!-- INICIO DE SCRIPT -->
    <script>
        // Seleccionamos el botón y los selects
        const agregarAsesorBtn = document.getElementById('agregar-asesor');
        const asesorSelect = document.getElementById('asesor-select');
        const rolSelect = document.getElementById('rol-select');

        // Seleccionamos la tabla donde vamos a agregar los asesores
        const tablaAsesores = document.getElementById('tabla-asesores');

        // Agregamos un listener al botón
        agregarAsesorBtn.addEventListener('click', function() {
            // Obtenemos el valor del select
            const asesorId = asesorSelect.value;
            const asesorNombre = asesorSelect.options[asesorSelect.selectedIndex].text;
            const rol = rolSelect.value;

       
            // Validamos si el asesor ya está en la tabla
            const filas = tablaAsesores.querySelectorAll('tr');
            let asesorRepetido = false;
            filas.forEach(function(fila) {
                const idFila = fila.querySelector('.asesor-id');
                if (idFila && idFila.value === asesorId) {
                    asesorRepetido = true;
                }
            });

            // Mostramos un mensaje de error si el asesor ya está en la tabla
            if (asesorRepetido) {
                alert('El asesor ya está en la tabla');
                return;
            }


            // Si el asesor no está en la tabla, creamos una nueva fila
            if (!asesorRepetido) {
                const nuevaFila = document.createElement('tr');
                nuevaFila.innerHTML = `
                    <td>${asesorNombre}</td>
                    <td>${rol}</td>
                    <td><button class="btn btn-danger btn-sm eliminar-asesor">Eliminar</button></td>
                    <input type="hidden" id="asesor_id" class="asesor-id" value="${asesorId}">
                `;

                // Agregamos la nueva fila a la tabla
                tablaAsesores.querySelector('tbody').appendChild(nuevaFila);

                // Agregamos un listener al botón de eliminar para eliminar la fila correspondiente
                const eliminarAsesorBtn = nuevaFila.querySelector('.eliminar-asesor');
                eliminarAsesorBtn.addEventListener('click', function() {
                    nuevaFila.remove();
                });
            }
        });
    </script>

    <!-- GUARDAR EN LA BD -->
    
    <script>
    function guardarProyecto() {
        // Obtener valores de los campos del formulario
        const nombreProyecto = document.querySelector('#nombre-proyecto').value;
        const idCliente = document.querySelector('#nombre_cliente').value;
        const idUniversidad = document.querySelector('#nombre_universidad').value;
        const idTipoProyecto = document.querySelector('#tipo_proyecto').value;
        const fechaEntrega = document.querySelector('#reservation').value;
        const monto = document.querySelector('#monto').value;
        const asesores = [];
        const tablaAsesores = document.querySelector('#tabla-asesores tbody');
        for (let i = 0; i < tablaAsesores.children.length; i++) {
            const nombre = tablaAsesores.children[i].children[0].textContent;
            const rol = tablaAsesores.children[i].children[1].textContent;
            asesores.push({ nombre, rol });
        }

        // Crear objeto FormData con los valores del formulario
        const formData = new FormData();
        formData.append('nombreProyecto', nombreProyecto);
        formData.append('idCliente', idCliente);
        formData.append('idUniversidad', idUniversidad);
        formData.append('idTipoProyecto', idTipoProyecto);
        formData.append('fechaEntrega', fechaEntrega);
        formData.append('monto', monto);
        formData.append('asesores', JSON.stringify(asesores));

        // Enviar petición AJAX
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../insert/agregarProyecto.php');
        xhr.send(formData);
    }

    </script>

