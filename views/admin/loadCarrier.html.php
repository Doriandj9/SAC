<div id="cnt" class="ideb">
    Ingresar Carrera:
</div>

<div class="tbing">
    <form action="" method="post">
        <table class="table-coordinator">
            <thead>
                <tr  class="hdtb">
                    <th>Codigo de Carrera</th>
                    <th> Nombre de la Carrera </th>
                    <th> Facultad </th>
                    <th> Periodo Academico </th>
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
                        <select name="facultad" id="anios">
                            <option value="#" selected disabled>-- Asignar Facultad --</option>
                            <?php foreach ($facultades as $facultad) : ?>
                                <option value="<?= $facultad->id_facultad; ?>"> <?= $facultad->nombre_facultad ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>
                        <select name="periodo" id="anios" required>
                            <option value="#" selected disabled>-- Asignar Periodo --</option>
                            <?php foreach ($periodo as $value) : ?>
                                <option value="<?= $value->id_periodo_academico; ?>"> <?= $value->id_periodo_academico; ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>
        <button id="btnGuardar"> Guardar</button>
</div>
</form>
</div>
</div>