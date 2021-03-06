<?php
  include "database/data.php";
  $gebruikersnaam = $_POST['gebruikersnaam'];
  $wachtwoord = $_POST['wachtwoord'];

  try {
    // We proberen (try) verbinding te maken
    $database = new PDO("mysql:host=$servername;dbname=$database", $uid, $pwd);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }catch (PDOException $e) {
      // En we vangen (catch) fouten af zodat ons script niet crasht
      echo "Fout bij verbinding maken: " . $e->getMessage();
      exit;
  }

  $sql = 'SELECT * FROM account';
  $statement = $database->query($sql);

  foreach ($statement as $rij) {
    if($gebruikersnaam === $rij['gebruikersnaam']){
      if(password_verify($wachtwoord , $rij['wachtwoord'])){
        if($rij['active'] === "true"){
          $_SESSION = true;
          $_SESSION['id'] = $rij['id'];
          $_SESSION['vertificatie'] = $rij['vertificatie'];
        }
      }
    }
  }
?>
