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
                            <option value="">Software</option>
                            <option value="">Turismo</option>

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