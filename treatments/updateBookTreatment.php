<?php

    // Automatic load model ->
    function chargerClass ($class) {
        require "../model/$class.php";
    }// EO chargerClass

    spl_autoload_register('chargerClass');

    /*===================================
    |   TREATMENT FOR UPDATING A BOOK   |
    ===================================*/

    /*-------------
    |   D A T A   |
    -------------*/

    // Data via 'isset', '$_POST' and iif ->
    $title = isset($_POST['title']) ? $_POST['title'] : null;
    $author = isset($_POST['author']) ? $_POST['author'] : null;
    $releaseYear = isset($_POST['releaseYear']) ? $_POST['releaseYear'] : null;
    $category = isset($_POST['select-category']) ? $_POST['select-category'] : null;
    $collection = isset($_POST['collection']) ? $_POST['collection'] : null;
    $bookId = $_POST['modify'];

    // Data for input file 'cover' ->
    $upload_dir = "../public/images/covers/COVER-";
    $upload_file = $upload_dir.basename($_FILES['cover']['name']);
    $upload_fileType = strtolower(pathinfo($upload_file,PATHINFO_EXTENSION));
    $coverIsModify = 0;

    /*----------------------------------
    |   C H E C K I N G  I N P U T S   |
    ----------------------------------*/

    // Check if any input is empty ->
    $check_is_empty = ($title == null || $author == null || $releaseYear == null || $category == null);

    if ($check_is_empty) {
        $errorMsg = "Vous devez remplir tous les champs du formulaire marqués comme obligatoire(*)...";
        include('../views/error.html.php');
        exit();
    }// EO if

    // Check 'title' length ->
    if (strlen($title) < 2 || strlen($title) > 32) {
        $errorMsg = "Le titre ne peut contenir qu'entre 2 et 32 caractères...";
        include('../views/error.html.php');
        exit();
    }// EO if

    // Check 'author' length ->
    if (strlen($author) < 2 || strlen($author) > 24) {
        $errorMsg = "Le nom de l'auteur ne peut contenir qu'entre 2 et 24 caractères...";
        include('../views/error.html.php');
        exit();
    }// EO if

    // Check releaseYear ->
    if (!is_numeric($releaseYear) || strlen((string)$releaseYear) !== 4) {
        $errorMsg = "L'année de sortie doit être renseignée en chiffres (ex : 2021)...";
        include('../views/error.html.php');
        exit();
    }// EO if

    // Check 'collection' length ->
    if($collection) {
        if (strlen($collection) < 2 || strlen($collection) > 24) {
            $errorMsg = "Oups! Le titre de la collection ne peut contenir qu'entre 2 et 24 caractères...";
            include('../views/error.html.php');
            exit();
        }
    }// EO if

    if($upload_file !== null) {
        // Check 'file' size ->
        if ($_FILES['cover']['size'] > 1500000) {
            $errorMsg = "Le fichier dépasse la taille maximum autorisée (1.5mo)...";
            include('../views/error.html.php');
            exit();
        }
        if ($upload_fileType !== "jpg" && $upload_fileType !== "png" && $upload_fileType !== "jpeg") {
            $errorMsg = "Le format du fichier n'est pas autorisé. Formats acceptés : JPG, JPEG, PNG.";
            include('../views/error.html.php');
            exit();
        }// EO if
        $coverIsModify = 1;
    }

    /*-------------------------
    |   T R E A T M E N T S   |
    -------------------------*/
   
    // Send file 'cover' ->
    if($coverIsModify == 1) {
        try {
            move_uploaded_file($_FILES["cover"]["tmp_name"], $upload_file);
        } catch(Exception $errorMsg) {
            $errorMsg = "Une erreur est survenue lors du téléchargement de votre fichier, veuillez réessayer ultérieurement...";
            include('../views/error.html.php');
            exit();
        }// EO try/catch
    }// EO if
    
    // Update to mongo ->
    try {
        $forUpdate = new BookManager($title, $author, $releaseYear, $category, $collection, $upload_file);
        $forUpdate->updateBook($bookId);
        $validateMsg = "Le livre a été modifié avec succès";
        include('../views/validate.html.php');
        exit();
    } catch(Exception $errorMsg) {
        $errorMsg = "Erreur lors de l'envoi vers la base de données, veuillez réessayer ultérieurement...";
        include('../views/error.html.php');
        exit();
    }// EO try/catch