<div class="msg">
    <div>¡¡Importante!!</div>
    <div>* Se deberán subir los archivos para el distributivo académico, lista de docentes y lista de estudiantes.</div>
    <div>* Se recomienda no utilizar caracteres especiales en el nombre de los archivos.</div>
</div>
<div id="cnt" class="link">
    <h4>DISTRIBUTIVO</h4>
</div>
<div class="continUp">
    <div class="layUp">Archivos a subir:</div>
    <div class="frmUp">
        <form action="" method="post" enctype="multipart/form-data">
            
            <div id="uploader">
                <div>Arrastra y suelta los archivos aquí<br>
                <br>Tamaño máximo por archivo de <?php echo ini_get("upload_max_filesize");?></div>
            </div>

            <div>* Subir archivos .json</div>
            
            <div id="filesList">
            <!-- Se muestra el nombre del documento subido -->
            </div>

            <!-- <div><button type="submit" id="send" name="send" class="btn">Enviar</button></div> -->
        </form>
        <form action="/admin/data/save" method="post">
            <input type="text" name="guardar" hidden>
            <input type="submit" value="Guardar" id="guardar-data-click">
        </form>
    </div>
</div>