

<div id="cnt" class="ideb">
    Cambio de Clave
</div>
<?php 
            if(isset($error)): 
        ?>
        <div class="alert2">
            <img src="/public/img/warning.png" alt="warning" width="30px">
            <p><?= $error; ?></p>
        </div>
        <?php endif; ?>
<div class="cl">
<form action="" method="POST">
    <div>
    <label for="password">Contraseña actual:</label>
    <input type="password" name="password" id="password" placeholder="Contraseña Actual" required> 
    </div>
    <div>
    <label for="passwordnew">Contraseña nueva:</label>
    <input type="password" name="passwordnew" id="passwordnew" placeholder="Contraseña Nueva" required>
    </div>
    <div>
    <label for="passwordnew1">Confirme la contraseña nueva:</label>
    <input type="password" name="passwordnew1" id="passwordnew1" placeholder="Confirme Contraseña Nueva" required>
    </div>
    <div class="oculta">
        <input type="hidden" name="cod" id="cod" value="<?= $usuario->ci_profesor; ?>">
    </div>
    <div>
    <input type="submit" value="Guardar" id="btnGuardarContrasenia" class="btn">
    </div>
</form>
</div>


