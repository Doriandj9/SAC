<div id="cnt">Permisos de acceso</div>
<div class="permisaccess">
                        <table class="permistable">                            
                            <thead>
                            <tr class="ldu"> 
                                <th colspan="3">Lista de Usuarios</th>
                            </tr>
                            <tr class="jpght">
                                <th>Nombre</th>
                                <th>Correo Electronico</th>
                                <th>Editar permisos</th>                                
                            </tr>
                            </thead>
                    <tbody>
                    <?php foreach($teachers as $value): ?>
                            <tr class="nnnn">
                                <td><?= $value->nombre_profesor ?? '' ;?></td>
                                <td><?= $value->email_profesor ?? ''; ?> </td>
                                <td><a href="/admin/permises/access?id=<?=$value->ci_profesor; ?>">EDITAR</a></td>                            
                            </tr>
                    <?php endforeach; ?>
                            </tbody>
                            </table>
                    </div>