
<?php
$servername ="localhost";
$uid="root";
$pwd="";
$database="fotos";
$con = mysqli_connect($servername,$uid,$pwd,$database);

if(!$con){
  die('kan niet verbinden: '.mysqli_error($con));
}



$Datum=date("Y-m-d");
$titel = $_POST['titel'];
$description = $_POST['description'];




//foto upload
if(isset($_FILES['image'])){
  $errors = array();
  $file_name = $_FILES['image']['name'];
  $file_size = $_FILES['image']['size'];
  $file_tmp = $_FILES['image']['tmp_name'];
  $file_type = $_FILES['image']['type'];

  // de explode string-functie breekt een string in een array
  // hierbij breek je de string na de . (punt) waardoor je de bestands type hebt
  $filename_deel = explode('.',$_FILES['image']['name']);
  // end laat de laatste waarde van de array zoen
  $bestandstype = end($filename_deel);
  // voor het geval er JPG ipv jpg is geschreven
  $file_ext = strtolower($bestandstype);

  $bestandstypen = array("jpeg","jpg","png");

  if(in_array($file_ext,$bestandstypen)=== false){
  $errors[] = "<script>alert('Dit bestandstype kan niet, kies een JPEG of een PNG bestand.');</script>";
  }

  if($file_size > 2097152){
    $errors[] ='Het bestand moet kleiner zijn dan 2 MB';
        echo "<script>alert(Het bestand moet kleiner zijn dan 2 MB');</script>";
  }
  if(empty($errors)==true){
     // move_upload_file stuurt je bestand naar een andere lokatie

     move_uploaded_file($file_tmp,"uploads/".$file_name);
     echo "<script>alert('Gelukt');</script>";
  } else{
    echo "<script>alert('het bestand is te groot');</script>";
     // print_r($errors);
  }
//function word aangeroepen
  bestanden_upload($con,$file_name,$Datum,$titel,$description);
}
//upload info
function bestanden_upload($con,$file_name,$Datum,$description,$title){
  $sql="INSERT INTO fotos(Datum,user,filepath,description,titel)
  values('$Datum', '','uploads/$file_name','$description','$title')";
$file_name="";
if ($con->query($sql)=== TRUE){
  echo "<script>alert(' verbinding');</script>";
}
else{
  echo "<script>alert('Error".$sql."<br>".$con->error.";</script>";
}
}

 ?>

<!DOCTYPE html>
<html lang="nl" dir="ltr">
  <head>
    <link rel="stylesheet" type="text/css" href="upload.css">
    <meta charset="utf-8">
    <title> geupload</title>
  </head>
  <body>

    <div class="wrapper">
      <div id="header">
        <a href="home.php">
          <img src="logo/logo.png" class="Logo1" alt="Logo">
        </a>

        <div id="topnav">
          <ul>
            <li>
              <a class="button" href="profiel.html">Profiel</a>
            </li>
            <li>
              <a class="button" href="upload.php" style="background-color: #B22222; color: #ffffff;">Upload</a>
            </li>
          </ul>
        </div>
        <h1 style="float: right; margin-top: 2em;">Social Stories</h1>
      </div>
</div>
<div class="container">
    <h3>foto uploaden</h3>

      <div id="midle" class="midle">
    <div id="uploadbox">
    beste <div id=naam>uw naam</div> upload hier je foto
    <form action="" method="POST" enctype="multipart/form-data">
    <input  required type="file" name="image">
<select required id="catogorie" name="catogorie">
  <option value="cat">cat</option>
  <option value="memes">memes</option>
  <option value="cursed">cursed</option>
  <option value="nsfw">nsfw</option>
  <option value="huizen">huizen</option>
  <option value="animals">animals</option>
  <option value="food">food</option>
</select>


    </div>
    <div id="deRest">
<input id="titel" type="text" name="titel" placeholder="name" value="">
<br>
<div id="pic"></div>

<input id="description" type="text" name="description" placeholder="description" value="">
      <input type="submit"/>
      </form>
      <div>

        </div>

      </div>
      <!-- //einde upload -->
      <!-- //einde wrapper -->
    </div>
</div>

  </body>
</html>
