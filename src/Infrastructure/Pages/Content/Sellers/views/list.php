<h2>Commerçants </h2>

<table class="highlight">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->contextList['sellersList'] as $sellersLoop) : ?>

            <tr <?php if ($sellersLoop->status == 'draft') : ?>class="grey-text" <?php endif; ?>>
                <td><?php echo $sellersLoop->id ?></td>
                <td><?php echo $sellersLoop->title ?></td>
                <td> <?php if ($sellersLoop->status == 'draft') : ?>
                        <li class="grey-text large material-icons">visibility_off</li>
                    <?php else : ?>
                        <li class="green-text large material-icons">visibility</li>
                    <?php endif; ?>
                </td>

                <td class="right-align">
                    <a href="sellers_edit_<?php echo $sellersLoop->id ?>.html" class="waves-effect waves-light btn"><i class="material-icons left">edit</i>Modifier</a>

                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<div class="fixed-action-btn">

    <a href="sellers_add.html" class="btn-floating btn-large waves-effect waves-light "><i class="material-icons">add</i> Ajouter une actualité</a>
</div>