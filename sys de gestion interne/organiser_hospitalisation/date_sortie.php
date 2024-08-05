<?php

session_start();
include '../../inc/db.php';
$date=$_SESSION['date'];


if(isset($_POST['suivant']))
{
    $date_sortie=$_POST['date_de_sortie'];
    $_SESSION['date_de_sortie'] = $date_sortie;
    if(empty($date_sortie))
    {
        echo "vous dever saire une date de sortie";
    }
    else
    {
        header("location:chambre.php");
        
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ajouter_operation/style-operation.css">
    <title>date de sortie</title>
</head>
<body>
<div class="profile">
       <a href="../profile chef de service/profile-chef.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez rendez-hos">
                <h1 >Organisation d'une Hospitalisation</h1> 
                <h3 >Choisissez un jour de sortie pour cette Hospitalisation</h3> 
                    <form action="date_sortie.php" method="POST">
                        <label for="date"> date de sortie: </label>
                        <input type="date" name="date_de_sortie" id="date">
                        <button type="submit" name="suivant"> suivant</button>
                    </form>
         </div>
    </div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>