<?php
//Connexion à la base de données
//(via PDO, utilisez la méthode de votre choix comme le type de base de données de votre choix)
$pdo = new PDO(
    'mysql:host=localhost;dbname=securite', 'root', '');

//On vérifie que l'utilisateur a bien envoyé les informations demandées
if(isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["password2"])){
	//On vérifie que password et password2 sont identiques
	if($_POST["password"] == $_POST["password2"]){
		//On utilise alors notre fonction password_hash :
		$hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
		//Puis on stock le résultat dans la base de données :
		$query = $pdo->prepare('INSERT INTO membres (username, mail, password) VALUES(:username, :mail, :password);');
		$query->bindParam(':username', $_POST["username"]);
    $query->bindParam(':mail', $_POST["mail"]);
		$query->bindParam(':password', $hash);
		$query->execute();
		header('Location: index.php');
		exit();
	}
}
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>L'art de la sécurité</title>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <div class="block-global block-home">
      <div class="container">
        <div class="row">
          <div class="col-6">
            <h2>Inscription</h2>
            <form action="" method="POST">
              <label>Identifiant :</label>
          		<input type="text" name="username" required /><br /><br />
              <label>Email :</label>
          		<input type="text" name="mail" required /><br /><br />
          		<label>Mot de passe :</label>
          		<input type="password" name="password" required /><br /><br />
          		<label>Retapez mot de passe :</label>
          		<input type="password" name="password2" required /><br /><br />
          		<input type="submit" />
          	</form>
          </div>
        </div>
      </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>

    <script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript">

    </script>
  </body>
</html>
