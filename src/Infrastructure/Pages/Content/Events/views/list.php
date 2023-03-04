<h2>Actualités </h2>

<table class="highlight">
    <thead>
        <tr>
            <th>#</th>
            <th>Date de publication</th>
            <th>Titre</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->contextList['eventsList'] as $eventsLoop) : ?>

            <tr <?php if ($eventsLoop->status == 'draft') : ?>class="grey-text" <?php endif; ?>>
                <td><?php echo $eventsLoop->id ?></td>
                <td><?php echo $eventsLoop->publication_date ?></td>
                <td><?php echo $eventsLoop->title ?></td>
                <td> <?php if ($eventsLoop->status == 'draft') : ?>
                        <li class="grey-text large material-icons">visibility_off</li>
                    <?php else : ?>
                        <li class="green-text large material-icons">visibility</li>
                    <?php endif; ?>
                </td>

                <td class="right-align">
                    <a href="events_edit_<?php echo $eventsLoop->id ?>.html" class="waves-effect waves-light btn"><i class="material-icons left">edit</i>Modifier</a>

                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<div class="fixed-action-btn">

    <a href="events_add.html" class="btn-floating btn-large waves-effect waves-light "><i class="material-icons">add</i> Ajouter une actualité</a>
</div>