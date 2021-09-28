
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
                        <form action="" method="post" enctype="multipart/form-data">
                        <table>
                            <thead>
                            <tr class="hdtb">
                                <th>Criterio</th>
                                <th>Estandar</th>
                                <th>Elemento</th>
                                <th>Nombre de la evidencia</th>
                                <th colspan="3">Formato</th>
                                <th>Estado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="bytb">
                                <td>{Criterio}</td>
                                <td>{Estandar}</td>
                                <td>{Elemento}</td>
                                <td>{Nombre de la evidencia}</td>
                                <td><label for="pdf"><img src="/public/img/pdf1.svg" alt=".pdf" title="Clic aquí para subir un archivo."></label><input type="file" id="pdf" name="pdf" accept=".pdf" /></td>
                                <td><label for="doc"><img src="/public/img/doc1.svg" alt=".doc" title="Clic aquí para subir un archivo."></label><input type="file" id="doc" name="doc" accept=".doc" /></td>
                                <td><label for="xlsx"><img src="/public/img/xls1.svg" alt=".xlsx" title="Clic aquí para subir un archivo."></label><input type="file" id="xlsx" name="xlsx" accept=".xlsx" /></td>
                                <td>{no entregado}</td>
                            </tr>
                            </tbody>
                        </table>
                        <input type="submit" value="Guardar">
                        </form>
                    </div>
                    
                    