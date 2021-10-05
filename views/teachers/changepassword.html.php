

<div id="cnt" class="ideb">
    Cambio de Clave
</div>
<div class="cl">
<form action="changepassword" >
     <div>
    <label for="password">Contraseña anterior:</label>
    <input type="password" name="password" id="password"> 
    </div>
    <div>
    <label for="passwordnew">Contraseña nueva:</label>
    <input type="password" name="passwordnew" id="passwordnew">
    </div>
    <div>
    <label for="passwordnew1">Confirmar la contraseña nueva:</label>
    <input type="password" name="passwordnew1" id="passwordnew1">
    </div>
    <div>
        <input type="hidden" name="cod" id="cod" value="<?= "cod"; ?>">
    </div>
    <div>
    <input type="submit" value="Guardar" id="btnGuardarContrasenia">
    </div>
</form>
</div>


