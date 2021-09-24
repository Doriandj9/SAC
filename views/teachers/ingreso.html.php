<div id="cnt" class="ideb">
    Ingreso de Evidencias
</div>
<form action="">
    <div class="pdt">
        <div id="fpdt">Periodo de tiempo:</div>
        <div><select name="anios" id="anios">
                <option value="#" selected disabled>-- seleccione una opción --</option>
                <option value="5">5 años</option>
                <option value="4">4 años</option>
                <option value="3">3 años</option>
                <option value="2">2 años</option>
                <option value="1">1 año</option>
                <option value="semestral">semestrales</option>
            </select></div>
        <div class="bntlt"><button type="submit">Listar</button></div>
    </div>
</form>
<!-- Generando tabla dentro de un div -->
<div class="tbing">
    <table>
        <tr class="hdtb">
            <td>Criterio</td>
            <td>Estandar</td>
            <td>Elemento</td>
            <td>Nombre de la evidencia</td>
            <td>
                Formato
            </td>
            <td>Estado</td>
        </tr>
        <tr class="bytb">
            <td>{Criterio}</td>
            <td>{Estandar}</td>
            <td>{Elemento}</td>
            <td>{Nombre de la evidencia}</td>
            <div>
            <td><label for="pdf"><img src="/public/img/pdf1.svg" 
            alt=".pdf" title="Clic aquí para subir un archivo."></label><input type="file" id="pdf" name="pdf" accept=".pdf" /></td>
            <td><label for="doc"><img src="/public/img/doc1.svg"
             alt=".doc" title="Clic aquí para subir un archivo."></label><input type="file" id="doc" name="doc" accept=".doc" /></td>
            <td><label for="xlsx"><img src="/public/img/xls1.svg" 
            alt=".xlsx" title="Clic aquí para subir un archivo."></label><input type="file" id="xlsx" name="xlsx" accept=".xlsx" /></td>
            </div>

            <td>{no entregado}</td>
        </tr>
    </table>
</div>