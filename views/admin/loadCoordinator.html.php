<div id="cnt" class="ideb">
    Ingresar Coordinadores:
</div>
<div class="tbing">
    <form action="" method="post">
        <table class="table-coordinator">

            <thead>
                <tr class="hdtb">
                    <th>Cedula</th>
                    <th>Nombre y Apellido</th>
                    <th>E-mail</th>
                    <th>Carrera</th>
                    <th>Periodo Academico</th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="cedula" required>
                    </td>
                    <td>
                        <input type="text" name="nombres" required>
                    </td>
                    <td>
                        <input type="email" name="email" required>
                    </td>
                    <td>
                        <select name="carrera" id="anios" required>
                            <option value="#" selected disabled>-- Asignar Carrera --</option>
                            <?php foreach($carreras as $value): ?>
                                    <option value="<?= $value->cod_carrera; ?>"> <?= $value->nombre_carrera; ?> </option>
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
        <div id="ba">
            <div class="content-for-evaluation">
                <input type="submit" value="Guardar" id="btnGuardar">
            </div>
        </div>
    </form>


</div>