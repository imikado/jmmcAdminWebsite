<nav>
    <div class="nav-wrapper">
        <a href="#" class="brand-logo">Administration du site</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">

            <?php foreach ($this->contextList['linkList'] as $linkLoop) : ?>
                <li <?php if ($this->contextList['pageSelected'] == $linkLoop->pageSelected) : ?>class="active" <?php endif ?>><a href="<?php echo $linkLoop->link ?>"><?php echo $linkLoop->label ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>