<?php if (isset($this->contextList['errorList'])) : ?>
    <p><?php echo join(',', $this->contextList['errorList']) ?></p>
<?php endif; ?>

<form action="" method="POST">


    <div class="row">
        <div class="col offset-s4 s4">

            <div class="card">

                <div class="card-content">


                    <div class="row">
                        <div class="input-field col s12">
                            <input name="username" id="email" type="text" class="validate">
                            <label for="email">Login</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col s12">
                            <input name="password" id="password" type="password" class="validate">
                            <label for="password">Password</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col offset-s4 s4">
                            <input class="btn" type="submit" value="Connexion" />
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</form>