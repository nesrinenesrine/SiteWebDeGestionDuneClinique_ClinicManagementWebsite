<?php 

session_start();
include '../../inc/db.php';
$err_sp="";
if(isset($_POST['confirmer']))
{
    $specialite= htmlspecialchars($_POST['specialite']) ;
    if(empty($specialite))
    {
        $err_sp="vous devez saisire specialite";
    }
    else
    {
        $sql_ajouter_specialite="INSERT INTO `specialite`(`nom_specialite`) 
        VALUES ('$specialite')";
        if(mysqli_query($conn,$sql_ajouter_specialite))
        {
            header("location:../profile_admin/profil_admin.php");
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
    <link rel="stylesheet" href="../ajouter_operation/style-operation.css">
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profile_admin/profil_admin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez op">
         <h1 >ajouter une nouveau specialite</h1> 
        
            <form action="ajouter.php" method="post">
                <label for="specialite" >specialite:</label>
                <input type="text" name="specialite" id="specialite"> <br>
                <!-- span ta3 err dirilha designe dok apr nbdelha apr mohim fhmti -->
                <span><?php echo $err_sp;?></span> 
                
                <button type="submit" name="confirmer"> confirmer</button>
            </form>
            </div>
   </div>
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>

