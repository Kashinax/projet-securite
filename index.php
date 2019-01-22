<?php
session_start();
//Connexion à la base de données
//(via PDO, utilisez la méthode de votre choix comme le type de base de données de votre choix)
$bdd = new PDO(
    'mysql:host=localhost;dbname=securite', 'root', '');

//Nous vérifions que l'utilisateur a bien envoyé les informations demandées
if(isset($_POST['formconnexion'])) {
   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);
   if(!empty($mailconnect) AND !empty($mdpconnect)) {
      $requser = $bdd->prepare("SELECT * FROM membres WHERE username = '$mailconnect' AND mail = '$mdpconnect'");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
      if($userexist == 1) {
         $userinfo = $requser->fetch();
         $_SESSION['id'] = $userinfo['id'];
         $_SESSION['username'] = $userinfo['username'];
         header("Location: profil.php?id=".$_SESSION['id']);
      } else {
         $erreur = "Mauvais mail ou mot de passe !";
      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
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
            <h2>Connexion</h2>
          	<form action="" method="POST">
              <input type="username" name="mailconnect" placeholder="Username" />
              <input type="password" name="mdpconnect" placeholder="Mot de passe" />
              <br /><br />
              <input type="submit" name="formconnexion" value="Se connecter !" />
          	</form>
          </div>
        </div>
      </div>
    </div>

    <script src="bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>
  </body>
</html>
