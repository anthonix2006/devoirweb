<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	 <h1>RECHERCHE DUN LIVRE </h1>
	 <?php
	  $typeRech= $_POST['typeRech'];
      $termeRech= $_POST['termeRech'];

      $termeRech= trim($termeRech);

      if(!$typeRech || !$termeRech){
      	echo 'vous navez entre aucun terme de recherche. Reesayez';
      	exit;
      }

      $typeRech= addslashes($typeRech);
      $termeRech= addslashes($termeRech);

      @ $db = mysql_connect('localhost','simeu','motdepasse');

      if(!$db){
      	echo 'erreur : echec de connexion a la base de donnees Essayez plutard';
      	exit;
      }

      mysql_select_db('bibliot',$db);
      $query = "SELECT * FROM livres WHERE $typeRech LIKE :termeRech";

      $result = mysql_query($query);

      $num_results = 0;
      $num_results = mysql_num_rows($result);

      echo "<p> Nombre de livres trouves : '.$num_results.'</p>";

      for($i=0;$i<$num_results;$i++){
      	$row = mysql_fetch_array($result);

      	echo '<p><strong>'.($i+1).'.Titre: ';
      	echo htmlspecialchars(stripslashes($row['titre']));
      	echo '</strong><br/>Auteur:';
      	echo stripslashes($row['auteur']);
      		echo '<br/>ISBN:';
      	echo stripslashes($row['isbn']);
      		echo '<br/>qte:';
      	echo stripslashes($row['stock']);
      		echo '<br/>prix:';
      	echo stripslashes($row['prix']);
      }
      mysql_close($db);
      ?>
</body>
</html>