<?php

declare(strict_types=1);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo "<link rel='stylesheet' href='src/style/main.css'>" ?>
    <title><?php echo $name ?></title>
</head>

<body>
    <div class="container">
        <header class="header">
            <h1><?php echo $name . "\n page" ?></h1>
        </header>
        <footer class="footer">
        </footer>
    </div>
</body>

</html>