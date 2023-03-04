<h2>Redimensionnement image</h2>

<form action="" method="POST" enctype="multipart/form-data">


    <div class="file-field input-field">
        <div class="btn">
            <span>Image</span>
            <input name="imageToResizePath" type="file">
        </div>
        <div class="file-path-wrapper">
            <input class="file-path validate" type="text">
        </div>
    </div>

    <div class="row">
        <div class="input-field col s12">
            <input name="imageToResizeWidth" id="width" type="number" min="10" max="1000" class="validate">
            <label for="width">Largeur (px) </label>
            <span class="helper-text" data-error="La taille doit être comprise entre 10 et 1000px" data-success="Taille correcte">Vérification</span>

        </div>
    </div>

    <p><input type="submit" class="waves-effect waves-light btn" value="Redimensionnez" /></p>

</form>