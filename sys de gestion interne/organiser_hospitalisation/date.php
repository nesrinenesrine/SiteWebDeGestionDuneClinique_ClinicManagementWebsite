<?php
session_start();
include '../../inc/db.php';
$id_service=$_SESSION['id_service'];
$id_patient=$_SESSION['id_patient'];



if(isset($_POST['suivant']))
{
    $date = $_POST['date'] ;
    echo $date;
    if(!empty($date))
    {
        $_SESSION['date'] = $date ;
        header("location:./date_sortie.php");
    }else
    {
        echo "vous devez saisire une date";
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../ajouter_operation/style-operation.css">
    <title>date de hospitalissation</title>
</head>
<body>
<div class="profile">
       <a href="../profile chef de service/profile-chef.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez rendez-hos">
         <h1 >Organisation d'une Hospitalisation</h1> 
          <h3 >Choisissez un jour pour cette Hospitalisation</h3> 
                <form action="date.php" method="POST">
                    <label for="date"> date:</label>
                    <input type="date"  name="date"  id="date" >
                    <button type="submit" name="suivant"> Suivant</button>
                </form>
         </div>
    </div>
    
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>