<div class="body_lg">
    
    <div class="box_lg">
        <div class="head_lg"></div>
            <div class="cont_lg">
                
                <div class="box" id="bxs">
                    <div class="head_lg">Bienvenid@s</div>
                    <div class="lg">
                        <h3>SAC (Sistema de Aseguramiento de la Calidad).</h3>
                        <p>Esta diseñado con la finalidad de gestionar el fluido de información de los criterios de evaluación de las carreras que sugiere el CEAACES. <br> Es un sistema web de facil acceso que garantiza seguridad y consistencia en el manejo de la información.</p>
                    </div>
                </div>
                
                <div class="box2" id="bxs">
                    <div class="head_lg">Inicio de sesión</div>
                    <div class="lg">
                    <?php if( isset($error)): ?>
                    <div class="alert">
                        <img src="/public/img/warning.png" alt="warning" width="30px">
                        <p>
                            <?= $error ?>
                        </p>
                    </div>
                    <?php endif; ?>    
                        <div class="form">
                            <form action="" method="POST" id="form-login">
                                <div><label>Usuario:</label></div>
                                <div class="ipt"><input type="text" placeholder="Correo institucional" name="email" id="email_institucional" required autofocus="on"></div>
                                <div><label>Contraseña:</label></div>
                                <div class="ipt"><input type="password" placeholder="Contraseña" id="pwd" class="masked" name="password" required />
                                </div>
                                <div class="cbox"><input  type="checkbox" name="eye" id="eye" onclick="showHide()"><label for="eye"> Mostrar contraseña.</label>
                                </div>
                                <div><button class="btn_ing">Ingresar</button></div>
                            </form> 
                        </div>
                    </div>
                </div>
            
            </div>
    </div>

</div>