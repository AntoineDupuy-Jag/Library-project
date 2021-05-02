<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>~ Ajouter ~</title>
    </head>

    <body>

        <div class="contenair">
            <h2>Ajouter un nouveau livre à notre collection &#10157;</h2>
            <form method="POST" action="../treatments/addBookTreatment.php" enctype="multipart/form-data">
                <label for="title">Titre :</label><br>
                    <input type="text" name="title"><br>
                <label for="author">Auteur :</label><br>
                    <input type="text" name="author"><br>
                <label for="releaseYear">Année de sortie :</label><br>
                    <input type="number" placeholder="1900" step="1" min="1" max="2021" name="releaseYear"><br>
                <label for="select-category">Catégorie :</label><br>
                    <select name="select-category" id="select-category">
                        <option selected> ~ Choisir une catégorie dans la liste ~ </option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Policier">Policier</option>
                        <option value="Science-Fiction">Science-Fiction</option>
                        <option value="Classique">Classique</option>
                        <option value="Historique">Historique</option>
                    </select><br>
                <label for="collection">Collection <em>(facultatif)</em> :</label><br>
                    <input type="text" name="collection"><br>
                <label for="cover">Couverture <em>(facultatif)</em> :</label><br>
                    <input type="file" name="cover"><br>
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="reset" class="btn btn-warning">Annuler</button>
                <a href="../index.php">Revenir à l'accueil</a>
             </form>
          </div>
    
    </body>

</html>