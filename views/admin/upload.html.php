<div class="msg">
    <div>¡¡Importante!!</div>
    <div>* Se deberán subir los archivos para el distributivo académico, lista de docentes y lista de estudiantes.</div>
    <div>* Se recomienda no utilizar caracteres especiales en el nombre de los archivos.</div>
</div>
<div class="scrollbar">
    <div id="cnt" class="link">
        <h4>DISTRIBUTIVO</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="subir.php" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="fileText__Dtr" id="fileText__Dtr" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="inputFile__Dtr" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="inputFile__Dtr" id="inputFile__Dtr" accept=".json" class="form__file" required>
                </div>
                <progress id="progressBar" value="0" max="100" class="progressBar"></progress>
                <input type="submit" value="Guardar" class="btn" name="saveFile__Dtr" id="saveFile__Dtr">
            </form>

            <!-- <form action="/admin/data/save" method="post">
                <input type="text" name="guardar" hidden>
                <input type="submit" value="Guardar" id="guardar-data-click" class="btn">
            </form> -->

        </div>
    </div>

    <div id="cnt" class="link">
        <h4>LISTA DE DOCENTES</h4>
    </div>
    <div class="continUp">
        <div class="layUp">Archivo a subir:</div>
        <div class="frmUp">
            <form action="subir.php" method="post" enctype="multipart/form-data" id="formUpload">
                <div class="container__file">
                    <input type="text" name="fileText__ListD" id="fileText__ListD" placeholder="Buscar archivo" readonly class="file__txt">
                    <label for="inputFile__ListD" class="form__file-btn">&#128193; Examinar</label>
                    <input type="file" name="inputFile__ListD" id="inputFile__ListD" accept=".json" class="form__file" required>
                </div>
                <progress id="progressBar" value="0" max="100" class="progressBar"></progress>
                <input type="submit" value="Guardar" class="btn" name="saveFile__ListD" id="saveFile__ListD">
            </form>
        </div>
    </div>
</div>






<script src="/public/js/containText.js"></script>
<script src="/public/js/progressBar.js"></script>