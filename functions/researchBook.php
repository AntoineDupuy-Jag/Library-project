<?php

    // Connect to MongoDB ->
    require('../vendor/autoload.php');
    $mongo = new MongoDB\Client("mongodb://localhost:27017");
    $dbCollection = $mongo->QoopheeLibrary->Books;
    
    if (isset($_GET['book'])) {
      
        $bookResearched = (String) $_GET['book'];
        $regex = new MongoDB\BSON\Regex('^'.$bookResearched);
        
        $result = $dbCollection->find([
          'title' => $regex
        ]);
          
        foreach ($result as $booksFinded) { ?>
            <div style="margin-top: 10px; border-bottom: 2px, solid, #ccc;">
                <?= $booksFinded['title'].", de ".$booksFinded['author'] ?>
                <a href="views/showBook.php?id=<?= $booksFinded['_id'] ?>" class="btn btn-primary">Voir</a>
            </div>        
        <?php
        }
    }
?>