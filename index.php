<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/style.css">
        <title>MyLibraryOnPhp</title>
    </head>

    <body>

        <div class="contenair">
            
            <!-----------------------
            |     ADD A NEW BOOK    |  
            ------------------------>

            <div>
                <h2>&#10157; Ajouter un nouveau livre :</h2>
                <a href="views/addBookView.php">Par ici !</a>
            </div>

            <!-----------------------------
            |     DISPLAY BY CATEGORY     |  
            ------------------------------>

            <div>
                <h2>&#10157; Afficher par catégorie :</h2>
                <form method="POST" action="views/listBooksView.php">
                    <select name="category-to-show" id="category-to-show">
                        <option selected value="default"> ~ Choisir une catégorie dans la liste ~ </option>
                        <option value="Fantasy">Fantasy</option>
                        <option value="Policier">Policier</option>
                        <option value="Science-Fiction">Science-Fiction</option>
                        <option value="Classique">Classique</option>
                        <option value="Historique">Historique</option>
                    </select><br>
                    <div>
                        <button type="submit" class="btn btn-primary" style="margin-top: 8px;">Valider</button>
                        <a href="views/listBooksView.php">Tout voir</a>
                    </div>
                 </form>
            </div>

            <!-------------------------
            |     RESEARCH A BOOK     |  
            -------------------------->

            <div>
                <h2>&#10157; Trouver un livre :</h2>
                    <input type="text" id="search-bar" placeholder="Search here..."><br>
                    <div id="result-research"></div>
            </div>
      
        </div>

        <!-- For testing some shit :) -->
        <br><br><br><a href="test.php">TEST</a>

        <!-------------------------------------------
        |     SCRIPTS FOR SEARCH BAR (WITH AJAX)    |  
        -------------------------------------------->

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        
        <script>

            $(document).ready(function() {
                $('#search-bar').keyup(function() {
                    $('#result-research').html('');
                    var research = $(this).val()
                    if (research !== "") {
                        $.ajax({
                            type: 'GET',
                            url: 'functions/researchBook.php',
                            data: 'book=' + encodeURIComponent(research),
                            success: function(data) {
                                if (data !== "") {
                                    $('#result-research').append(data);
                                } else {
                                    document.getElementById('result-research').innerHTML = "<div> Aucun résultat... </div>"
                                }
                            }
                        });// EO .ajax
                    }
                });
            });// EO ready function

        </script>

    </body>
</html>