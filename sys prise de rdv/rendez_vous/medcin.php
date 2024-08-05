<?php
session_start();
include '../../inc/db.php';

if (!isset($_SESSION['userId'] , $_SESSION['id_specialite']))
{
    header("location:../index.php");
}
else
{
    $id_specialite=$_SESSION['id_specialite'];

    //selectione les medcun realitve a cette $specialite
    $sql_medecin="SELECT *
    FROM medcin 
    WHERE id_specialite ='$id_specialite'";
    if (mysqli_query($conn,$sql_medecin))
    {
        $result = mysqli_query($conn,$sql_medecin);
        $medecins=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
    echo ("error" . mysqli_error($conn) );
    }

    if (isset($_POST['suivant'])) 
    {
        if(empty($_POST['medcin']))
        {
            $err = "vous devez choisire un medecin";
        }else
        {
            $_SESSION['id_medcin']=$_POST['medcin'];
            $id=$_POST['medcin'];
            //id rdv du medecin
            $sql_id_jour="SELECT *
                        FROM medcin WHERE id_medcin='$id'";
            if (mysqli_query($conn,$sql_medecin))
            {
                $result = mysqli_query($conn,$sql_id_jour);
                $id_jour_rdvs=mysqli_fetch_all($result, MYSQLI_ASSOC);
                $_SESSION['id_jour_rdv']=$id_jour_rdvs[0]['id_jour_rdv'];
            }else 
            { 
            echo ("error" . mysqli_error($conn) );
            }

            header("location:date.php");
            exit();
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/medcin.css">
    <link rel="stylesheet" href="style-rendezvous.css">
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profile.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>

<div class = "box">

    <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
    <div class="rendez">
        <h1 >Prendre votre rendez-vous</h1> 
        <h3 >Choisissez votre médecin</h3>
    <!-- ********************medcin**************************  -->
    <form action="medcin.php"    method="POST" class ="formulaire" >
    <label for="medcin" >médecin:</label> <br> <br>
        <select  id="medcin" name="medcin" onchange="javascript:submit(this);"  class ="zone_de_choix" >
            <option></option>
            <?php  foreach($medecins as $medecin):?>
                <option value="<?php echo $medecin['id_medcin'];?>" <?php if(isset($_POST['medcin'])){if($_POST['medcin']==$medecin['id_medcin']){echo "selected";}} ?> >
                    <?php echo  $medecin['nom_medcin']." ".$medecin['prenom_medcin']; ?>
                </option>
            <?php endforeach;?> 
        </select> <br>
        
        <span><?php if (isset($_POST['suivant']) && empty($_POST['medcin'])){echo $err;} ?> </span><br>
        
        
        <button type="submit" name="suivant" id= "suivant" >suivant</button>
        <div class="link">
        <a href="specialite.php" id="precedant">précédent</a>
        </div>
        
        
    </form>
</div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  
</body>
</html>