<div class="list-group">
    <?php
    foreach ($tab as $value) {
        echo '<a href="' . $path . $value->getId() . '" class="list-group-item list-group-item-action">'
            . $value->getUsername() . '</a>';
    }

    ?>

</div>