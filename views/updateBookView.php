<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>~ Modifier ~</title>
    </head>

    <?php      
        function chargerClass ($class) {
            require "../model/$class.php";
        }// EO chargerClass
            
        spl_autoload_register('chargerClass');
            
        $bookId = isset($_GET['id']) ? $_GET['id'] : null;
        $forSearch = new BookManager(null, null, null, null, null, null);
        $bookToUpdate = $forSearch->findBookById($bookId);
    ?>
    
    <body>
      
        <div class="contenair">
            <h2>Modifier <?= $bookToUpdate['title'] ?> &#10157;</h2>
            <form method="POST" action="../treatments/updateBookTreatment.php" enctype="multipart/form-data">
                <label for="title">Titre :</label><br>
                    <input type="text" name="title" value="<?= $bookToUpdate['title'] ?>"><br>
                <label for="author">Auteur :</label><br>
                    <input type="text" name="author" value="<?= $bookToUpdate['author'] ?>"><br>
                <label for="releaseYear">Année de sortie :</label><br>
                    <input type="number" step="1" min="1" max="2021" name="releaseYear" value="<?= $bookToUpdate['releaseYear'] ?>"><br>
                <label for="select-category">Catégorie :</label><br>
                    <select name="select-category" id="select-category">
                        <option <?php if($bookToUpdate['category'] == "Fantasy"){echo "selected";} ?> value="Fantasy">Fantasy</option>
                        <option <?php if($bookToUpdate['category'] == "Policier"){echo "selected";} ?> value="Policier">Policier</option>
                        <option <?php if($bookToUpdate['category'] == "Science-Fiction"){echo "selected";} ?> value="Science-Fiction">Science-Fiction</option>
                        <option <?php if($bookToUpdate['category'] == "Classique"){echo "selected";} ?> value="Classique">Classique</option>
                        <option <?php if($bookToUpdate['category'] == "Historique"){echo "selected";} ?> value="Historique">Historique</option>
                    </select><br>
                <label for="collection">Collection <em>(facultatif)</em> :</label><br>
                    <input type="text" name="collection" value="<?= $bookToUpdate['collection'] ?>"><br>
                <img src="<?= $bookToUpdate['cover'] ?>" class="card-img-top" style="width: 50px; height: 80px;">
                <label for="cover">Couverture <em>(facultatif)</em> :</label><br>
                    <input type="file" name="cover" value="<?= $bookToUpdate['cover'] ?>"><br>
                <button type="submit" class="btn btn-primary" name="modify" value="<?= $bookId ?>">Modifier</button>
                <button type="reset" class="btn btn-warning">Annuler</button>
                <a href="<?= $_SERVER['HTTP_REFERER']; ?>">Retour</a>
             </form>
          </div>
    
    </body>

</html>