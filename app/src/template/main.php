<?php 

declare(strict_types=1);

?>

<div class="content">
    <ul class="content-list">
        <?php foreach($data as $value): ?>
        <?php require "src/template/item.php"?>
        <?php endforeach ?>
    </ul>
</div>