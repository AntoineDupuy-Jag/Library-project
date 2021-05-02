<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="style.css" rel="stylesheet">
            <title>~ Liste par catégorie ~</title>
        </head>
        
        <?php
            function chargerClass ($class) {
                require "../model/$class.php";
            }// EO chargerClass
        
            spl_autoload_register('chargerClass');

            $category = isset($_POST['category-to-show']) ? $_POST['category-to-show'] : null;
            $forDisplay = new BookManager(null, null, null, null, null, null);
        ?>

        <body>

                <?php if($category !== null && $category !== "default") { ?>
                            <h1>Livres de la catégorie <?= $category ?></h1>
                            <?= $content = $forDisplay->getBooksByCategory($category) ?>
                <?php } else { ?>
                            <h1>Liste complète</h1>
                            <?= $content = $forDisplay->getAllBooks(); ?>
                <?php } ?>

        </body>

</html>