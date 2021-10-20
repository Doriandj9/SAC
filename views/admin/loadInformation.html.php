
<div class="tbing content-table-information"> 
    <form action="" method="post">
    <table>
        <thead>
            <tr class="hdtb">
                <th>Nombre Evidencia</th>
                <th>Fecha de Entrega</th>
                <th>Fecha de Expiracion</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 0 ?>
            <?php foreach( $evidences as $value ): ?>
                
                
            <tr class="tdbody-information">
                <td><?=$value->nombre_evidencia ?? ''; ?></td>
                <td> <?= $value->fecha_inicio ?? 

                "
            <table>
                <tbody>
                    <tr>
                        <th>Fecha</th>
                        <td>
                        <input type='date' name='fecha".$i."[dateI]' id=''> 
                        </td>
                    
                    </tr>
                
                    <tr>
                    <th>Hora</th>
                        <td>
                        <input type='time' name='fecha".$i."[timeI]' id=''>
                        </td>
                    </tr>
                </tbody>
            </table>
                "; ?>
            </td>

                <td> <?= $value->fecha_fin ??

                "
                <table>
                <tbody>
                    <tr>
                        <th>Fecha</th>
                        <td>
                        <input type='date' name='fecha".$i."[dateF]' id=''> 
                        </td>
                    
                    </tr>
                
                    <tr>
                    <th>Hora</th>
                        <td>
                        <input type='time' name='fecha".$i."[timeF]' id=''>
                        </td>
                    </tr>
                </tbody>
            </table>
                
                
                "; ?> 
                <input type="hidden" name="fecha<?=$i;?>[cod]" value="<?= $value->cod_evidencia ?>" >
                 </td>
            </tr>
                <?php $i = $i + 1 ; ?>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="numbers-page" id="pages-for-data">
        <?php
             $count = ceil(intval($count[0]) / 15);
             $page = intval($page);
             for ($i = 1; $i <= $count; $i++ ):
        ?>

        <a <?php if($i == $page){
            echo ' class="active" ';
        }
        ?>
        href="/admin/load/information?page=<?= $i;?>"><?= $i;?></a>

      <?php endfor;  ?>
    </div>
    <input type="submit" value="Guardar" class="buttun-save-data-information btn">
    </form>
</div>


