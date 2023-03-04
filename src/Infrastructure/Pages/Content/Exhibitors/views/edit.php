<?php $exhibitors = $this->contextList['exhibitors']; ?>
<h2>Modifier un Exposant</h2>


<?php if (isset($this->contextList['errorList']) and count($this->contextList['errorList']) > 0) : ?>

    <div class="row">
        <div class="col s12 m6">
            <div class="card red darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Il y a une ou plusieurs erreurs</span>
                    <?php foreach ($this->contextList['errorList'] as $errorLoop) : ?>
                        <p>- <?php echo $errorLoop ?></p>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <form onsubmit="return loadWysiwigBefore()" class="col s12" method="POST">
        <textarea id="content" name="content"></textarea>

        <div class="row">
            <div class="input-field col s12">
                <input value="<?php echo $exhibitors->title ?>" placeholder=" Le titre de l'actualité" id="title" name="title" type="text" class="validate">
                <label for="title">Titre</label>

            </div>
        </div>
        <div class="row">


            <div class="input-field col s4">


                <div class="switch">
                    <label>
                        Brouillon
                        <input <?php if ($exhibitors->status == 'published') : ?>checked<?php endif ?> name="active" type="checkbox">
                        <span class="lever"></span>
                        En ligne
                    </label>
                </div>

            </div>



        </div>

        <!-- WYSISWYG -->
        <div class="row">
            <div class="col s12">
                <button class="btn waves-effect waves-light" type="button" onClick="formatTo('bold')" name="action">
                    <i class="material-icons">format_bold</i>
                </button>

                <button class="btn waves-effect waves-light" type="button" onClick="formatTo('italic')" name="action">
                    <i class="material-icons">format_italic</i>
                </button>

                <button class="btn waves-effect waves-light" type="button" onClick="formatTo('underline')" name="action">
                    <i class="material-icons">format_underlined</i>
                </button>


                <button class="btn waves-effect waves-light" type="button" onClick="formatTo('justifyLeft')" name="action">
                    <i class="material-icons">format_align_left</i>
                </button>

                <button class="btn waves-effect waves-light" type="button" onClick="formatTo('justifyCenter')" name="action">
                    <i class="material-icons">format_align_center</i>
                </button>

                <button class="btn waves-effect waves-light" type="button" onClick="formatTo('justifyRight')" name="action">
                    <i class="material-icons">format_align_right</i>
                </button>

                <button class="btn waves-effect waves-light" type="button" onClick="link()" name="action">
                    <i class="material-icons">insert_link</i>
                </button>


                <input class="btn" type="file" accept="image/*" id="file" style="display: none;" onchange="getImage()" />
                <label for="file" class="btn">

                    <i class="material-icons">photo</i>
                </label>

                &nbsp;

                <a target="_blank" href="image_resize.html" class="purple btn waves-effect waves-light">
                    <i class="material-icons">photo_size_select_large</i>
                </a>


            </div>
            <div class="input-field col s12">

                <div contenteditable id="contentPreview"><?php echo $exhibitors->content ?></div>

            </div>
        </div>
        <!-- END WYSISWYG -->


        <div class="row">
            <div class="input-field col offset-s10 s2 right-align">
                <button class="btn waves-effect waves-light" type="submit" name="action">Enregistrer
                    <i class="material-icons right">save</i>
                </button>
            </div>
        </div>

    </form>
</div>