<div class="modal fade" id="modal-agregar-proyecto">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Agregar Proyecto</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form id="formulario-proyecto">
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
                    <input type="text" class="form-control">
                </div>
                </div>
                <!-- FIN MONTO -->
            </div>
            </form>

            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
              
              <button type="button" class="btn btn-primary" onclick="guardarProyecto()">Guardar</button>



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
                    <input type="hidden" class="asesor-id" value="${asesorId}">
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
        const nombreProyecto = $('input[type=text]').val();
        const idCliente = $('select').val();
        const inicioFinEntrega = $('input[type=text].float-right').val();
        const monto = $('input[type=text].form-control:last').val();
        console.log('XD');
        // Obtener detalles del proyecto de la tabla "detalle_proyecto"
        const detallesProyecto = [];
        $('#tabla-detalles-proyecto tbody tr').each(function() {
        const fila = $(this);
        const detalle = {
            texto: fila.find('.detalle-proyecto-texto').text(),
            monto: fila.find('.detalle-proyecto-monto').text()
        };
        detallesProyecto.push(detalle);
        });

        // Realizar llamada AJAX al archivo PHP
        $.ajax({
        type: 'POST',
        url: '../includes/insert/guardar_proyecto.php',
      
        data: {
            nombreProyecto: nombreProyecto,
            idCliente: idCliente,
            inicioFinEntrega: inicioFinEntrega,
            monto: monto,
            detallesProyecto: JSON.stringify(detallesProyecto)
        },
        success: function(data) {
            alert('El proyecto se ha guardado correctamente');
        },
        error: function() {
            alert('Ha ocurrido un error al guardar el proyecto');
        }
        });
    }
    </script>


    
