<?php 

session_start();
include '../../inc/db.php';

$id_rdv = $_SESSION['id_rdv'];
$sql="SELECT * FROM `rdv` WHERE rdv.id_rdv='$id_rdv'";
if(mysqli_query($conn,$sql))
{
    $result = mysqli_query($conn,$sql);
    $rdv = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $etat= $rdv[0]['etat_rdv'];
}else 
{ 
    echo ("error" . mysqli_error($conn));
}

$sql_consultaion="SELECT * FROM `consultation` WHERE consultation.id_rdv='$id_rdv'";
        if(mysqli_query($conn,$sql_consultaion))
        {
            $result = mysqli_query($conn,$sql_consultaion);
            $consultaion = mysqli_fetch_all($result, MYSQLI_ASSOC);
            
        }else 
        { 
            echo ("error" . mysqli_error($conn));
        }
    
if(isset($_POST['submit']))
{
    $discription=$_POST['discription'];
    if(empty($discription))
    {   
        echo "vous dever saisire une discription";
    }elseif(empty($_POST['cas']))
    {
        echo "vous devez choisire un cas";
    }
    else
    {
        $cas = test_input($_POST['cas']);
        $sql=" INSERT INTO `consultation`( `id_rdv`, `cas_disc`, `description`) 
        VALUES ('$id_rdv','$cas','$discription')";
        if(mysqli_query($conn,$sql))
        {
            header("location:../profile_medcin/profile_medcin.php");
            exit();
        }else 
        { 
            echo ("error" . mysqli_error($conn));
        }
    }
}
function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/style-consultation.css">
    <title>rapport consultation</title>
</head>
<div class="profile">
       <a href="../profile_medcin/profile_medcin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
 <div class="mains">
     
    <div class="nv_medecin2"> 
    <h3>Ecrire Votre Consultation</h3>
        <img class ="imgdate" src="../../img/logo-bleu.svg" alt=""  width= "300px" height= "200px" >
        <form class="form-date" action="consultation.php" method="post">
        <?php if($etat==0):?>
        <div class="form-input">
            <textarea name="discription" id="" cols="30" rows="10"></textarea>
          
            <label for="discroption">Rapport</label>
        </div>
        <div class="form-radio">
            <label for="cas">Cas :</label>
            <input type="radio" name="cas" id="cas" value="normal"> Normal
            <input type="radio" name="cas" id="cas" value="grave"> Grave
            <input type="radio" name="cas" id="cas" value="tres grave"> très Grave
        </div>
        <button type="submit" name="submit">Envoyer</button>
      <?php endif;?>

    <?php if($etat==1):?>
        <p> <?php echo $consultaion[0]['description']; ?></p>
        <p> <?php  echo $consultaion[0]['cas_disc'];?></p>
    <?php endif?>
    </form>
    </div>
    
    
</div>
</div>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 
    
</body>
</html>
