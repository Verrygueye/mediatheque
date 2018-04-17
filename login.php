<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
            <title>EXERCICE PAGE DE CONNEXION AVEC UTILISATEUR</title>
            <link rel="stylesheet" type="text/css" href="style.css">
  </head>
      <body>
          <a href="tableau.php">Reservez à l'admin </a>

         <div id="formulaire">
              <div class="header">
  	         <h2>Login</h2>
      </div>
	 
  <form method="post" action="login.php">
  	   <?php include('errors.php'); ?>
  	   <div class="input-group">
  		        <label>Username</label>
  		        <input type="text" name="username" >
  	</div>
  	<div class="input-group">
  		    <label>Password</label>
  		    <input type="password" name="password">
  	</div>
  	<div class="input-group">
  		        <button type="submit" class="btn" name="login_user">Login</button>
  	</div>
  	<p>
  		PAS encore membre? <a href="register.php">Devenz membre </a>
  	</p>
</form>
  </div>
  </body>
  </html>