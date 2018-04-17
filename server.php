<?php
session_start();

// initialisation des variables à 0
$username = "";
$email    = "";
$errors = array(); 

// connexion avec la base de  donnée(chaine de connexion)
$db = mysqli_connect('localhost', 'root', 'verrygueye', 'bd');

// Enregistrement utilisateur
if (isset($_POST['reg_user'])) {
  // recuperation des valeurs saisies par l'utilisateur
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // cas ou les champs sont vides

  if (empty($username)) { array_push($errors, "Username obligatoire"); }
  if (empty($email)) { array_push($errors, " le Email est obligatoire"); }
  if (empty($password_1)) { array_push($errors, "Password est obligatoire"); }
  if ($password_1 != $password_2) {
	array_push($errors, "les deux mots de passes doivent etre identhiques");
  }

  // Verification avec la base de donnée
  // ce nom d'utilisateur existe deja avec un autre mail
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { //  cas ou les users exites
    if ($user['username'] === $username) {
      array_push($errors, "Username existe déja");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email existe déja");
    }
  }

  // cas d'enregistrement s'il n'y'a pas d'erreur
  if (count($errors) == 0) {
  	$password = md5($password_1);//encryptage du mot de pass saisit dans la base de donnée
    // insertion ddes données saisies dans la base de donneé

  	$query = "INSERT INTO users (username, email, password) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "Vous estes bien connecter";
  	header('location: index1.php');
  }
}
// Connexion  des users
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  // cas connexion sans valeur
  if (empty($username)) {
    array_push($errors, "Username obligatoire ");
  }
  if (empty($password)) {
    array_push($errors, "Password obligatoire ");
  }
  //cas de verification avec les valeurs de la base de onnée
  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = ("Vous vous est
      es bien inscrit ");
      header('location: index1.php');
    }else {
      array_push($errors, "Ce nom d'utilisateur ne correspond pas avec ce mot de passe ");
    }
  }
}
