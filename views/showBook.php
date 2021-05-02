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

            $bookId = isset($_GET['id']) ? $_GET['id'] : null;
            $forDetails = new BookManager(null, null, null, null, null, null);
            $bookToShow = $forDetails->findBookById($bookId);
        ?>

        <body>

            <?php if($bookToShow !== null) { ?>
                      <h1>Détails</h1>
                      <div class="card" style="width: 18rem;">
                          <img src="<?= $bookToShow['cover'] ?>" class="card-img-top" style="width: 50px; height: 80px;">
                          <div class="card-body">
                              <h4 class="card-title" style="font-weight: bold;"><?= $bookToShow['title'] ?></h4>
                              <h5 class="card-title"><?= $bookToShow['author'] ?></h5>
                          </div>
                          <ul class="list-group list-group-flush">
                              <li class="list-group-item"><span class="sub-title">Date de sortie : </span><?= $bookToShow['releaseYear'] ?></li>
                              <li class="list-group-item"><span class="sub-title">Genre : </span><?= $bookToShow['category'] ?></li>
                              <li class="list-group-item"><span class="sub-title">Collection : </span><?= $bookToShow['collection'] ?></li>
                          </ul>
                          <div class="card-body">
                      <a href="updateBookView.php?id=<?= $bookToShow->_id ?>" class="btn btn-primary">Modifier</a>
                      <a href="deleteBookView.php?id=<?= $bookToShow->_id ?>" class="btn btn-warning">Supprimer</a>
                      </div>
                <?php } else { ?>
                            <h1>Aucun livre à afficher...</h1>
                            <a href="../index.php">Revenir à l'accueil</a>
                <?php } ?>

        </body>

</html>