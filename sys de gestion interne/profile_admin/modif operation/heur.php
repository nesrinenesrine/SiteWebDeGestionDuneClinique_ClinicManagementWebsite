<?php 
session_start();
include '../../../inc/db.php';
$nv_date=$_SESSION['date_modif'];
$heur=$_SESSION['heur'];
$duree=$_SESSION['dure'];


if (isset($_POST['suivant'])) 
{
    $nv_heur_deb=$_POST['heur'];
    
        $heur=strtok($nv_heur_deb, ':');
        $min=strstr($nv_heur_deb, ':');
        $heur_fin= $heur + $duree;
        
        if($heur_fin==24 or $heur_fin>24)
        {
            $heur_fin=$heur_fin-24;
        }
        $heur_fin= $heur_fin.$min;

        $sql="SELECT * FROM `operation` WHERE (operation.id_medcin='$id_medcin') and (operation.date='$date')
        and (('$nv_heur_deb' BETWEEN operation.heur and operation.heur_fin) 
        or ('$heur_fin' BETWEEN operation.heur and operation.heur_fin))" ;

        if(mysqli_query($conn , $sql))
        {
            $result =mysqli_query($conn , $sql);
            $row =mysqli_num_rows ($result);
            
            if($row == 0)
            {
                $_SESSION['nv_heur_deb']=$nv_heur_deb;
                $_SESSION['nv_heur_fin']=$heur_fin;
                header("location:bloc.php");
                exit();
            }
            else
            {
                echo "le medcin a une autre operation";
            }
        }
        else 
        {
            echo ("error" . mysqli_error($conn));
        }
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../ajouter_operation/style-operation.css">
    <title>Document</title>
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profil_admin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez op">
         <h1 >Modification d'une Opération</h1> 
        <h3 >Choisissez un nouveux jour pour cette Opération</h3>
            <form action="heur.php" method="POST">
                <label for="heur"> heur:</label>
                <input type="time"  name="heur" id="heur" value="<?php echo $heur;?>">  <br>
                <button type="submit" name="suivant"> suivant</button>
                <a href="http:date.php"> precdent</a>
            </form>
    </div>
   </div>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
