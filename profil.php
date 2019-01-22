<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=securite', 'root', '');

if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare("SELECT * FROM membres WHERE id = '$getid'");
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Profil</title>
    <link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">
  </head>
  <body>
    <h2>Profil de <?php echo $userinfo['username']; ?></h2>
         <br /><br />
         Pseudo = <?php echo $userinfo['username']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
  </body>
</html>
<?php
}
?>
