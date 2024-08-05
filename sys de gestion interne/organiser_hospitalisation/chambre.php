<?php
session_start();
include '../../inc/db.php';

$id_patient = $_SESSION['id_patient'];
$date = $_SESSION['date'];
$date_de_sortie = $_SESSION['date_de_sortie'];
$id_service = $_SESSION['id_service'];


$sql_lit_occupe = "SELECT * FROM `lit` 
JOIN etat_chambre 
ON (etat_chambre.id_lit=lit.id_lit) 
AND (etat_chambre.id_chambre=lit.id_chambre) 
AND (('$date' BETWEEN etat_chambre.date AND etat_chambre.date_sortie) 
OR ('$date_de_sortie' BETWEEN etat_chambre.date AND etat_chambre.date_sortie) 
OR ('$date' < etat_chambre.date ) AND ('$date_de_sortie' > etat_chambre.date_sortie))
 WHERE lit.id_service ='$id_service';
                    ";

if(mysqli_query($conn,$sql_lit_occupe))
{
    $result = mysqli_query($conn,$sql_lit_occupe);
    $lits_occupe=mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else
{
    echo 'ERROR' . mysqli_error($conn);
}


$sql_lit="SELECT * FROM lit WHERE lit.id_service='$id_service'";
if(mysqli_query($conn,$sql_lit))
{
    $result = mysqli_query($conn,$sql_lit);
    $lits=mysqli_fetch_all($result, MYSQLI_ASSOC);
}
else
{
    echo 'ERROR' . mysqli_error($conn);
}


$lits_dispo=array();
foreach($lits as $lit)
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
        array_push($lits_dispo,$lit);
    }
}


$chambres=array();
foreach($lits_dispo as $lit_dispo)
{
    array_push($chambres,$lit_dispo['id_chambre']);
}

$chambres_dispo=array_unique($chambres);


if(isset($_POST['suivant']))
{
    $id = $_POST['chambre'];
    $_SESSION['id_chambre'] = $id;
    header("location:./lit.php");
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
       <a href="../profile chef de service/profile-chef.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
         <div class="rendez rendez-hos">
                <h1 >Organisation d'une Hospitalisation</h1> 
                <h3 >Choisissez une chambre pour cette hospitalisation</h3> 
                <form action="chambre.php" method="post">
                    <label for="chambre">chambre </label>
                    <select name="chambre" id="chambre"  onchange="javascript:submit(this);">
                        <option value=""></option>
                        <?php foreach($chambres_dispo as $chambre_dispo):?>
                        
                            <option   value="<?php echo $chambre_dispo; ?>" 
                            <?php if(isset($_POST['chambre'])){if($_POST['chambre']==$chambre_dispo){echo "selected";}} ?>> 
                                <?php echo "chambre ".$chambre_dispo?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <button type="submit" name="suivant">confirmer</button>
                    <a href="date.php"> Précédent</a>
                </form>
        </div>
    </div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>