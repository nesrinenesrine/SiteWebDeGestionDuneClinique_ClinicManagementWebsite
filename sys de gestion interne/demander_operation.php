
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


    if(isset($_POST['submit']))
    {
        $description=$_POST['description'];
        $duree=$_POST['duree'];
        $cas=$_POST['cas'];
        $sql="INSERT INTO  demmande_operataion (`id_medcin`, `id_patient`, `description`, `cas`, `duree`, `etat`)
                VALUES('$id_medcin','$id_patient','$description','$cas','$duree','0')";
        if(mysqli_query($conn,$sql))
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
    <title>demander operation</title>
</head>
<body>
<div class="profile">
       <a href="./profile_medcin/profile_medcin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class="mains">
     
     <div class="nv_medecin2"> 
     <h3>Demandes Opérations</h3>
     <img class ="imgdate" src="../img/logo-bleu.svg" alt=""  width= "300px" height= "200px" >
    <form class="form-date3" action="demander_operation.php" method="POST"> 
        <div class="form-input input2">
         <input class ="form__input" type="text" id="description" name="description" placeholder=" ">
         <label  class ="form__label" for="description"> Description :</label>
        </div>
        <div class="form-input input3">
        
        <input class ="form__input" type="number" name="duree" id="duree">
        <label  class ="form__label" for="duree">Durée</label>
    </div>
        <div class="form-radio input4">
        <label for="cas"> Cas De Opérations:</label>
        <input type="radio" name="cas" id="tres_urgent" value="1">Très Urgent
        <input type="radio" name="cas" id="urgent" value="2">Urgent
        <input type="radio" name="cas" id="normal" value="3"> Normale
        </div>
        <button type="sibmit" name="submit" > Envoyer</button>
    </form>
    </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>  
</body>
</html>