<?php
session_start();
include '../../inc/db.php';

$id_patient=$_SESSION['id_patient'];
$date = $_SESSION['date'];
$date_de_sortie=$_SESSION['date_de_sortie'];
$id_service = $_SESSION['id_service'];
$id_chambre=$_SESSION['id_chambre'];

$id_dem_hospi=$_SESSION['id_hospi'];
$sql_lit_occupe="SELECT * FROM `lit` 
JOIN etat_chambre 
ON (etat_chambre.id_lit=lit.id_lit) 
AND (etat_chambre.id_chambre=lit.id_chambre) 
AND (('$date' BETWEEN etat_chambre.date AND etat_chambre.date_sortie) 
OR ('$date_de_sortie' BETWEEN etat_chambre.date AND etat_chambre.date_sortie) 
OR ('$date' < etat_chambre.date ) AND ('$date_de_sortie' > etat_chambre.date_sortie))
 WHERE lit.id_chambre = '$id_chambre'";


if(mysqli_query($conn,$sql_lit_occupe))
{
    $result = mysqli_query($conn,$sql_lit_occupe);
    $lits_occupe=mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else
{
    echo 'ERROR' . mysqli_error($conn);
}


$sql_lit_complet="SELECT * FROM lit WHERE lit.id_chambre = '$id_chambre'";
if(mysqli_query($conn,$sql_lit_complet))
{
    $result = mysqli_query($conn,$sql_lit_complet);
    $lits_complet=mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else
{
    echo 'ERROR' . mysqli_error($conn);
}

$lits=array();
    foreach($lits_complet as $lit)
    {
        $b=true;
        foreach($lits_occupe as $lit_occupe)
        {
            if($lit['id_lit'] ==  $lit_occupe['id_lit']  ) 
            {
                $b=false;
            }
        }
    
        if($b==true)
        {
            array_push($lits,$lit);
        }
    }


if(isset($_POST['suivant']))
{
    $id_lit= $_POST['lit'];
    $_SESSION['id_lit'] = $id_lit;
    echo $id_patient; echo "<br>";
    echo $date ; echo "<br>";
    echo $date_de_sortie; echo "<br>";
    echo $id_service ; echo "<br>";
    echo $id_chambre; echo "<br>";
    echo $id_lit; echo "<br>";
    $sql_insert="INSERT INTO `hospitalisation`(`id_patient`, `id_chambre`, `id_lit`, `id_service`, `date_entre`, `date_sortie`) 
    VALUES ('$id_patient','$id_chambre','$id_lit','$id_service','$date','$date_de_sortie')";
    if(mysqli_query($conn,$sql_insert))
    {   
        
        $sql_change_etat="UPDATE `demmande_hospiitalisation` SET demmande_hospiitalisation.etat=1
        WHERE demmande_hospiitalisation.id_dem_hos ='$id_dem_hospi'";
        if(mysqli_query($conn,$sql_change_etat))
        {
            header("location:../profile chef de service/profile-chef.php");
            exit();
        }
        else
        {
            echo 'ERROR' . mysqli_error($conn);
        }
        
        exit();
    }
    else
    {
        echo 'ERROR' . mysqli_error($conn);
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
    <title>lit</title>
</head>
<body>
<div class="profile">
       <a href="../profile chef de service/profile-chef.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez rendez-hos">
                <h1 >Organisation d'une Hospitalisation</h1> 
                <h3 >Choisissez une lit pour cette hospitalisation</h3> 
            <form action="lit.php" method="POST">
                <label for="id_lit">Lit</label>
                <select name="lit" id="lit"  onchange="javascript:submit(this); ">
                    <option ></option>
                    <?php foreach($lits as $lit):?>
                        <option value="<?php echo $lit['id_lit']; ?>" 
                        <?php if(isset($_POST['lit'])){if($_POST['lit']==$lit['id_lit']){echo "selected";}} ?>> 
                            <?php echo "lit".$lit['id_lit'] ;?>
                        </option>
                    <?php endforeach ?>
                </select>
                <button type="submit" name="suivant">confirmer</button>
            </form>
     </div>
    </div>  
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>    
</body>
</html>