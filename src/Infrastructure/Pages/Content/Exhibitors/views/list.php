<h2>Exposants </h2>

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
        <?php foreach ($this->contextList['exhibitorsList'] as $exhibitorsLoop) : ?>

            <tr <?php if ($exhibitorsLoop->status == 'draft') : ?>class="grey-text" <?php endif; ?>>
                <td><?php echo $exhibitorsLoop->id ?></td>
                <td><?php echo $exhibitorsLoop->title ?></td>
                <td> <?php if ($exhibitorsLoop->status == 'draft') : ?>
                        <li class="grey-text large material-icons">visibility_off</li>
                    <?php else : ?>
                        <li class="green-text large material-icons">visibility</li>
                    <?php endif; ?>
                </td>

                <td class="right-align">
                    <a href="exhibitors_edit_<?php echo $exhibitorsLoop->id ?>.html" class="waves-effect waves-light btn"><i class="material-icons left">edit</i>Modifier</a>

                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<div class="fixed-action-btn">

    <a href="exhibitors_add.html" class="btn-floating btn-large waves-effect waves-light "><i class="material-icons">add</i> Ajouter une actualité</a>
</div>