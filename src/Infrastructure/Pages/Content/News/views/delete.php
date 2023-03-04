<?php $news = $this->contextList['news']; ?>
<h2>Supprimer cette Actualité ?</h2>


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
                <label for="title">Titre</label>
                <span><?php echo $news->title ?></span>

            </div>
        </div>
        <div class="row">


            <div class="input-field col s4">


                <div class="switch">
                    <label>
                        Brouillon
                        <input <?php if ($news->status == 'published') : ?>checked<?php endif ?> name="active" type="checkbox">
                        <span class="lever"></span>
                        En ligne
                    </label>
                </div>

            </div>


            <div class="input-field offset-s4 col s4">
                <label for="title">Date de publication</label>
                <span><?php echo $news->publication_date ?></span>

            </div>
        </div>

        <!-- WYSISWYG -->
        <div class="row">

            <div class="input-field col s12">

                <div id="contentPreview"><?php echo $news->content ?></div>

            </div>
        </div>
        <!-- END WYSISWYG -->


        <div class="row">
            <div class="input-field col offset-s8 s4 right-align">
                <button class="btn waves-effect waves-light red" type="submit" name="action">Confirmer suppression
                    <i class="material-icons right">delete</i>
                </button>
            </div>
        </div>

    </form>
</div>