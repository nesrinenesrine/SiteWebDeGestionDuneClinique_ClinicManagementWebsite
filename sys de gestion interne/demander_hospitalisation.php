<?php
session_start();
if (!isset($_SESSION['userId']) )
{
    header("location:login.php");
    exit();
}
else{
    include '../inc/db.php';

    $id_patient=$_SESSION['id_patient'];
    $id_medcin= $_SESSION['userId'];
    $sql="SELECT * FROM medcin WHERE  medcin.id_medcin= $id_medcin";
    if(mysqli_query($conn,$sql))
    {
        $results=mysqli_query($conn,$sql);
        $x=mysqli_fetch_all($results,MYSQLI_ASSOC);
        $service=$x[0]['id_service'];
        echo $service;
    }
    else
    {
        echo ("error".mysqli_error($conn) );
    }

    if(isset($_POST['submit']))
    {
        $description=$_POST['description'];
        echo  $_POST['description'];
        $sql_ins = " INSERT INTO  demmande_hospiitalisation (`id_patient`, `id_service`, `etat`, `disc`) 
        VALUES('$id_patient','$service','0','$description')";

        if(mysqli_query($conn,$sql_ins))
        {
            
            header("location:./profile_medcin/profile_medcin.php");
            exit();
        }
        else
        {
            echo 'ERROR' . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-seconnecter.css">
     <link rel="stylesheet" href="../css/style-consultation.css">
    <title>Document</title>
</head>
<body>
   <div class="profile">
       <a href="./profile_medcin/profile_medcin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class="mains">
     
     <div class="nv_medecin2"> 
     <h3>Demande Hospitalisation</h3>
     <img class ="imgdate" src="../img/logo-bleu.svg" alt=""  width= "300px" height= "200px" >
    <form class="form-date2" action="demander_hospitalisation.php" method="POST"> 
        <div class="form-input input2">
        
        <input class ="form__input" type="text" id="description" name="description" >
        <label class ="form__label" for="description">Description :</label>
        </div>
        <button type="sibmit" name="submit" value="<?php if(isset($_POST['submit'])){ echo $_POST['description'] ;} ?>">Envoyer</button>
    </form>
    </div>
    </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>  
</body>
</html>