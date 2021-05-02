<!DOCTYPE html>
<html>
    <head>
	      <meta charset="utf-8">
	      <meta http-equiv="X-UA-Compatible" content="IE=edge">
	      <title>~ Erreur ~</title>
	      <link rel="stylesheet" href="">
    </head>

    <body>

        <div>
            <h3 style="text-align: center; color: red">
            <?= $errorMsg ?>
            </h3>
        </div>

        <div style="text-align: center;">
            <a href="<?= $_SERVER['HTTP_REFERER']; ?>">Retour</a>
        </div>

    </body>

</html>