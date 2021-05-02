<?php

    function chargerClass ($class) {
      require "../model/$class.php";
    }// EO chargerClass
      
    spl_autoload_register('chargerClass');

    /*-------------
    |   D A T A   |
    -------------*/

    $confirmation = isset($_POST['confirmation']) ? $_POST['confirmation'] : null;
    $bookId = isset($_POST['delete']) ? $_POST['delete'] : null;

    /*-----------------------
    |   T R E A T M E N T   |
    -----------------------*/

    if ($confirmation == "Oui") {
      try {
          $forDelete = new BookManager(null, null, null, null, null, null);
          $bookDeleted = $forDelete->deleteBook($bookId);
      } catch (Exception $errorMsg) {
        $errorMsg = "Erreur lors de la suppression, veuillez réessayer ultérieurement...";
        include('../views/error.html.php');
        exit();
      }// EO try/catch
    } else {
      header('Location: ../views/listBooksView.php');
    }

    if($bookDeleted) {
      $validateMsg = "Le livre a été supprimé avec succès";
      include('../views/validate.html.php');
      exit();
    }// EO if