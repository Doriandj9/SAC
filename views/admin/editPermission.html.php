<h4 class="admin-message-index">Editando los Permisos de {}</h4>

<div class="admin-permission">
    <form class="admin-permission-content">
            <?php foreach($permissions as $key=> $value): ?>
                <input type="checkbox" name="permission[]">
                <label for=""><?= $key ?></label>
            <?php endforeach; ?>
    </form>
</div>