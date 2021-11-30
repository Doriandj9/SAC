<h4 class="admin-message-index">Editando los Permisos de <?= $teacher->nombre_profesor;?> </h4>

<div class="admin-permission">
    <form class="admin-permission-content">
        <div class="fondo-permission">

            <?php foreach($permissions as $key=> $value): ?>
                <div>
               
                <input type="checkbox" name="permission[]"
                <?php if($teacher->hashPermission($value)){
                    echo "checked";
                } ?>
                value="<?= $value;?>">
                <label for=""><?= $key ?></label>
                </div>
            <?php endforeach; ?>
            <input type="submit" value="Guardar" class="submit-permission"/>
            </div>
    </form>
</div>

