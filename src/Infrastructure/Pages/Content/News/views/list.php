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
        <?php foreach ($this->contextList['newsList'] as $newsLoop) : ?>

            <tr <?php if ($newsLoop->status == 'draft') : ?>class="grey-text" <?php endif; ?>>
                <td><?php echo $newsLoop->id ?></td>
                <td><?php echo $newsLoop->publication_date ?></td>
                <td><?php echo $newsLoop->title ?></td>
                <td> <?php if ($newsLoop->status == 'draft') : ?>
                        <li class="grey-text large material-icons">visibility_off</li>
                    <?php else : ?>
                        <li class="green-text large material-icons">visibility</li>
                    <?php endif; ?>
                </td>

                <td class="right-align">
                    <a href="news_edit_<?php echo $newsLoop->id ?>.html" class="waves-effect waves-light btn"><i class="material-icons left">edit</i>Modifier</a>
                    <a href="news_delete_<?php echo $newsLoop->id ?>.html" class="waves-effect waves-light btn red"><i class="material-icons left">delete</i>Supprimer</a>

                </td>

            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<div class="fixed-action-btn">

    <a href="news_add.html" class="btn-floating btn-large waves-effect waves-light "><i class="material-icons">add</i> Ajouter une actualité</a>
</div>