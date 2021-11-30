<div class="carreras-content">
    <div class="lista-carreras">
    <div class="periodo-mensaje">
        Lista de Carreras 
    
        <ul>
            <?php foreach($carreras as $value): ?>

                <li> <?= $value->nombre_carrera ?> </li>

            <?php endforeach; ?>
        </ul>
        </div>
    </div>

    <div class="form-carreras margin-top-2">
        <form action="" method="post">
            <table id="new-carrier">
                    <thead>
                        <tr>
                            <th>Codigo de Carrera</th>
                            <th> Nombre de la Carrera </th>
                            <th> Facultad  </th>
                            <th> Periodo Academico  </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="text" name="cod-carrera" required>
                            </td>
                            <td>
                                <input type="text" name="nombre-carrera" required>
                            </td>
                            <td>
                                <select name="facultad" id="">
                                    <option value="#" selected disabled>-- Asignar Carrera --</option>
                                <?php foreach($facultades as $facultad): ?>
                                    <option value="<?= $facultad->id_facultad;?>"> <?= $facultad->nombre_facultad ?>   </option>
                                <?php endforeach; ?>
                                </select>
                            </td>
                            <td>
                        <select name="periodo" id="anios" required>
                            <option value="#" selected disabled>-- Asignar Periodo --</option>
                            <?php foreach($periodo as $value): ?>
                                    <option value="<?= $value->id_periodo_academico; ?>"> <?= $value->id_periodo_academico; ?> </option>
                                <?php endforeach; ?>
                        </select>
                    </td>
                        </tr>
                    </tbody>
            </table>
            <button id="btnGuardar"> Guardar</button>
        </form>
    </div>
</div>