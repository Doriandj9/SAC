<div class="msg">
    <div>¡¡Importante!!</div>
    <div>* Se deberán subir los archivos para el distributivo académico, lista de docentes y lista de estudiantes.</div>
    <div>* Se recomienda no utilizar caracteres especiales en el nombre de los archivos.</div>
</div>
<!-- Inicio de scrollBar -->
<div class="scrollbar">
    <!-- Formulario para distributivo -->
    <div id="cnt" class="link">
        <h4>EVIDENCIAS</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="fileText__Dtr" id="fileText__Dtr" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="saveFile__DtrI" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="inputFile__Dtr" id="saveFile__DtrI" class="form__file" required>
                </div>
                <progress id="saveFile__DtrP" value="0" max="100" class="progressBar"></progress>
                <button class="btn" id="saveFile__Dtr">Guardar</button>
            </form>
        </div>
    </div>
    <!-- Formulario para lista de docentes -->
    <div id="cnt" class="link">
        <h4>LISTA DE DOCENTES</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="fileText__ListD" id="fileText__ListD" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="saveFile__ListDI" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="inputFile__ListD" id="saveFile__ListDI" accept=".json" class="form__file" required>
                </div>
                <progress id="saveFile__ListDP" value="0" max="100" class="progressBar"></progress>
                <button class="btn" id="saveFile__ListD">Guardar</button>
            </form>
        </div>
    </div>


    <!-- Criterios -->
    <div id="cnt" class="link">
        <h4>CRITERIOS</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="fileText__Crt" id="fileText__Crt" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="saveFile__CrtI" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="" id="saveFile__CrtI" accept=".json" class="form__file" required>
                </div>
                <progress id="saveFile__CrtP" value="0" max="100" class="progressBar"></progress>
                <button class="btn" id="saveFile__Crt">Guardar</button>
            </form>
        </div>
    </div>
    <!-- Otro4 -->
    <div id="cnt" class="link">
        <h4>ESTANDARES</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="" id="fileText__Est" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="saveFile__EstI" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="" id="saveFile__EstI" accept=".json" class="form__file" required>
                </div>
                <progress id="saveFile__EstP" value="0" max="100" class="progressBar"></progress>
                <button class="btn" id="saveFile__Est">Guardar</button>
            </form>
        </div>
    </div>
    <!-- Otro5 -->
    <div id="cnt" class="link">
        <h4>ELEMENTOS FUNDAMENTALES</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="" id="fileText__Elm" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="saveFile__ElmI" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="" id="saveFile__ElmI" accept=".json" class="form__file" required>
                </div>
                <progress id="saveFile__ElmP" value="0" max="100" class="progressBar"></progress>
                <button class="btn" id="saveFile__Elm">Guardar</button>
            </form>
        </div>
    </div>
    <!-- Otro6 -->
    <div id="cnt" class="link">
        <h4>ELEMENTOS FUNDAMENTALES CON EVIDENCIAS</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="" id="fileText__Elme" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="saveFile__ElmeI" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="" id="saveFile__ElmeI" accept=".json" class="form__file" required>
                </div>
                <progress id="saveFile__ElmeP" value="0" max="100" class="progressBar"></progress>
                <button class="btn" id="saveFile__Elme">Guardar</button>
            </form>
        </div>
    </div>
    <!-- Fin del Scrollbar -->
</div>
<!-- Js para los formularios de file y progress -->
<script src="/public/js/containText.js"></script>
<script src="/public/js/progressBar.js"></script>