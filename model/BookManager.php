<?php

class BookManager {

    // Class attributes ->
    private $_title;
    private $_author;
    private $_releaseYear;
    private $_category;
    private $_collection;
    private $_cover;

    /*==========================
    |      MAGICS METHODS      |
    ==========================*/

    public function __construct($_title, $_author, $_releaseYear, $_category, $_collection, $_cover) {
        $this->_title = $_title;
        $this->_author = $_author;
        $this->_releaseYear = $_releaseYear;
        $this->_category = $_category;
        $this->_collection = $_collection;
        $this->_cover = $_cover;
    }// EO constructor
    //__________________________________________________________________

    public function __get($propertyRequested) {
        return $this->$propertyRequested;
    }// EO getter
    //__________________________________________________________________

    public function __set($propertyToModify, $value) {
        switch($propertyToModify) {
            case '_title' :       $this->_title = $value;
                                  break;
            case '_author' :      $this->_author = $value;
                                  break;
            case '_releaseYear':  $this->_releaseYear = $value;
                                  break;
            case '_category':     $this->_category = $value;
                                  break;
            case '_collection':   $this->_collection = $value;
                                  break;
            case '_cover':        $this->_cover= $value;
                                  break;
      }// EO switch
    }// EO setter
    //__________________________________________________________________

    /*===========================
    |       CRUD METHODS        |
    ===========================*/

    //--- SEND TO THE COLLECTION (CREATE) --->
    public function sendToMongo($bookToSend) {
        $dbCollection = $this->dbConnect();
        $bookToSend = $dbCollection->insertOne(
          [
            'title' => $this->_title,
            'author' => $this->_author,
            'releaseYear' => $this->_releaseYear,
            'category' => $this->_category,
            'collection' => $this->_collection,
            'cover' => $this->_cover
          ]);
          return $bookToSend;
    }// EO sendToMongo
    //__________________________________________________________________

    //--- DISPLAY ALL COLLECTION (READ) --->
    public function getAllBooks() {
        $dbCollection = $this->dbConnect();
        $cursor = $dbCollection->find();
        
        ob_start();
        foreach ($cursor as $book) { ?>
            <div class="card" style="width: 18rem;">
            <img src="<?= $book['cover'] ?>" class="card-img-top" style="width: 50px; height: 80px;">
                <div class="card-body">
                    <h5 class="card-title" style="font-weight: bold;"><?= $book['title']?></h5>
                    <h5 class="card-title"><?= $book['author']?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="sub-title">Date de sortie : </span><?= $book['releaseYear']?></li>
                    <li class="list-group-item"><span class="sub-title">Genre : </span><?= $book['category']?></li>
                    <li class="list-group-item"><span class="sub-title">Collection : </span><?= $book['collection']?></li>
                </ul>
                <div class="card-body">
                    <a href="#" class="btn btn-primary">Modifier</a>
                    <a href="#" class="btn btn-warning">Supprimer</a>
                </div>
            </div>
        <?php } ?>
        <?php $content = ob_get_clean();
        return $content;
    }// EO getAllBooks
    //__________________________________________________________________

    //--- DISPLAY BY CATEGORY (READ) --->
    public function getBooksByCategory($categoryToShow) {
        $dbCollection = $this->dbConnect();
        $cursor = $dbCollection->find(
          [
            'category' => $categoryToShow
          ]);
        
        ob_start();
        foreach ($cursor as $book) { ?>
            <div class="card" style="width: 18rem;">
            <img src="<?= $book['cover'] ?>" class="card-img-top" style="width: 50px; height: 80px;">
                <div class="card-body">
                    <h4 class="card-title" style="font-weight: bold;"><?= $book['title'] ?></h4>
                    <h5 class="card-title"><?= $book['author'] ?></h5>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="sub-title">Date de sortie : </span><?= $book['releaseYear'] ?></li>
                    <li class="list-group-item"><span class="sub-title">Genre : </span><?= $book['category'] ?></li>
                    <li class="list-group-item"><span class="sub-title">Collection : </span><?= $book['collection'] ?></li>
                </ul>
                <div class="card-body">
                    <a href="../views/updateBookView.php?id=<?= $book->_id ?>" class="btn btn-primary">Modifier</a>
                    <a href="../views/deleteBookView.php?id=<?= $book->_id ?>" class="btn btn-warning">Supprimer</a>
                </div>
            </div>
        <?php } ?>
        <?php $content = ob_get_clean();
        return $content;
    }// EO getBooksByCategory
    //__________________________________________________________________

    //--- FIND A BOOK BY HIS ObjectId --->
    public function findBookById($bookId) {
        $dbCollection = $this->dbConnect();
        $bookResearched = $dbCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($bookId)]);
        return $bookResearched;
    }// EO findBook
    //__________________________________________________________________

    //--- UPDATE --->
    public function updateBook($bookId) {
        $dbCollection = $this->dbConnect();
        $update = $dbCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($bookId)],
            ['$set' =>
              ['title' => $this->_title,
              'author' => $this->_author,
              'releaseYear' => $this->_releaseYear,
              'category' => $this->_category,
              'collection' => $this->_collection,
              'cover' => $this->_cover
            ]]);
        return $update;
    }// EO updateBook
    //__________________________________________________________________

    // --- DELETE --->
    public function deleteBook($bookId) {
        $dbCollection = $this->dbConnect();
        $deleteResult = $dbCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($bookId)]);
        return $deleteResult;
    }// EO deleteBook
    //__________________________________________________________________
    
    /*=======================================
    |  CONNECTION TO DATABASE'S COLLECTION  |
    =======================================*/

    private function dbConnect() {
        require('../vendor/autoload.php');
        $mongo = new MongoDB\Client("mongodb://localhost:27017");
        $dbCollection = $mongo->QoopheeLibrary->Books;
        return $dbCollection;
    }// EO dbConnect

  }// EO Book