<h2>Autres pages </h2>

<table class="highlight">
    <thead>
        <tr>
            <th>#</th>
            <th>Menu</th>
            <th>Page HTML</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->contextList['otherPagesList'] as $otherPagesLoop) : ?>

            <tr <?php if ($otherPagesLoop->status == 'draft') : ?>class="grey-text" <?php endif; ?>>
                <td></td>
                <td><?php echo $otherPagesLoop->title ?></td>
                <td><?php echo $otherPagesLoop->filename ?></td>

                <td class="right-align">
                    <a href="otherPages_edit_<?php echo $otherPagesLoop->id ?>.html" class="waves-effect waves-light btn"><i class="material-icons left">edit</i>Modifier</a>

                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<div class="fixed-action-btn">

    <a href="otherPages_add.html" class="btn-floating btn-large waves-effect waves-light "><i class="material-icons">add</i> Ajouter une actualité</a>
</div>