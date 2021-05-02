<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>~ Supprimer ~</title>
    </head>

    <?php      
        function chargerClass ($class) {
            require "../model/$class.php";
        }// EO chargerClass
            
        spl_autoload_register('chargerClass');

        $bookId = isset($_GET['id']) ? $_GET['id'] : null;
        $forSearch = new BookManager(null, null, null, null, null, null);
        $bookToDelete = $forSearch->findBookById($bookId);
    ?>

    <body>

        <h2>Suppression de <?= $bookToDelete['title'] ?></h2>

        <p>Vous êtes sur le point de supprimer définitivement <em><?=$bookToDelete['title']?></em> de <em><?=$bookToDelete['author']?>.</em></p>
        <form method="POST" action="../treatments/deleteBookTreatment.php">
            <p>Êtes-vous sûr ?</p>
            <div>
                <label for="yes">Oui</label>
                <input type="radio" name ="confirmation" id="yes" value="Oui">
                <label for="no">Non</label>
                <input type="radio" name ="confirmation" id="no" value="Non">
            </div>
            <div>
                <button type="submit" value="<?= $bookId ?>" name="delete">Valider</button>
            </div>
        </form>

    </body>
</html>