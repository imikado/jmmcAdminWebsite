<h2>Publication </h2>

<?php if (isset($this->contextList['messageList']) and is_array($this->contextList['messageList']) and count($this->contextList['messageList']) > 0) : ?>

    <div class="row">
        <div class="col s12 m6">
            <div class="card green darken-1">
                <div class="card-content white-text">
                    <span class="card-title">Information</span>
                    <?php foreach ($this->contextList['messageList'] as $messageLoop) : ?>
                        <p><?php echo $messageLoop ?></p>
                    <?php endforeach; ?>
                </div>

            </div>
        </div>
    </div>
<?php else : ?>

    <p> Vous pouvez cliquer pour générer le site</p>

    <form action="" method="post">
        <input type="hidden" name="publish" value="1" />
        <input class="btn" type="submit" value="Génerer le site web" />
    </form>
<?php endif; ?>