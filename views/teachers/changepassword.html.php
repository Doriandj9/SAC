

<div id="cnt" class="ideb">
    Cambio de Clave
</div>
<?php if(isset($error)): ?>
    <div class="alert2">
        <img src="/public/img/warning.png" alt="warning" width="30px">
        <p><?= $error; ?></p>
    </div>
<?php endif; ?>

<div class="form-pass">
    <form action="" method="post">
        <div class="oculta"><input type="hidden" name="cod" id="cod" value="<?= $usuario->ci_profesor; ?>"></div>
        <div><label for="password">Ingrese la contraseña actual:</label></div>
        <div class="ipt show">
            <input type="password" name="password" id="password" placeholder="Contraseña actual" required>
            <span>Mostrar</span>
        </div>
        <div><label for="passwordnew">Ingrese la nueva contraseña:</label></div>
        <div class="ipt show2">
            <input type="password" name="passwordnew" id="passwordnew" placeholder="Contraseña nueva" required>
            <span>Mostrar</span>
        </div>
        <div class="ipt show3">
            <input type="password" name="passwordnew1" id="passwordnew1" placeholder="Confirme contraseña nueva" required>
            <span>Mostrar</span>
        </div>
        <div><input type="submit" value="Guardar" id="btnGuardarContrasenia" class="btn"></div>
    </form>
</div>

