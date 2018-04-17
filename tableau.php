<?php 

if(isset($_GET['id']) && isset($_GET['action'])){
  if($_GET['action']==2){
  echo "a supprimer".   $_GET['id'];
  }
  } ?>

<!DOCTYPE html >
<html>
    <head>
        <title>Test Base de donnée</title>
         <link rel="stylesheet" type="text/css" href="bootstrap.min.css">
        <style>
          /*body{
            background-color: black;
           
          }
          p{
            color: white;
          }
        </style>
    </head>
<body>



<table class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>Id</th>
      <th>Username</th>
      <th>Email</th>
      <th>Action</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
        <?php
          $db = mysqli_connect('localhost', 'root', 'verrygueye', 'bd');
       
           $requete = "SELECT * FROM `users` ";
           $reponse = mysqli_query($db,$requete);
           
           $donnees = mysqli_fetch_array($reponse,MYSQLI_ASSOC);

          while ($donnees = mysqli_fetch_array($reponse)) // On boucle pour afficher toutes les données et on met toutes données dans un tableau
          {?>
    <tr>
      <td><?php echo $donnees['id'];?> </td>
       <td><?php echo $donnees['username'];?> </td>
        <td><?php echo $donnees['email'];?> </td>
        <td><a href="tableau.php?id=<?php echo $donnees['id'];?>&action=2"> Supprimer</a></td>
        <td><a href="tableau.php?id=$donnes['id']">Modifier</a></td>
    </tr>
  <?php

   }  
   mysqli_close(); // On oubli pas de déconnecter la base de données
  ?>


  </tbody>
</table>


<input type="submit" name="Supprimer" value="Supprimer">

</body>
</html>


