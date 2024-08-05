<?php 
session_start();
include '../../../inc/db.php';
$id_service=$_SESSION['id_service'];
$id_chambre=$_SESSION['id_chambre'];
$date=$_SESSION['date_modif'];
$date_de_sortie=$_SESSION['nv_date_sortie'];
$sql_lit_occupe="SELECT * FROM `lit` 
                    JOIN etat_chambre ON 
                    (etat_chambre.id_lit=lit.id_lit) AND 
                    (etat_chambre.id_chambre=lit.id_chambre) AND 
                    (('$date' BETWEEN etat_chambre.date AND etat_chambre.date_sortie) OR 
                    ('$date_de_sortie' BETWEEN etat_chambre.date AND etat_chambre.date_sortie))
                    WHERE lit.id_service='$id_service';";

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
    $id_chambre=$_POST['chambre'];
    $_SESSION['nv_chambre']=$_POST['chambre'];
    header("location:lit.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../organiser_hospitalisation/style-hos.css">
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profile-chef.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../../img/CLINIQUE DE CONFORT.svg" alt=""></div>
         <div class="rendez">
            <form action="chambre.php" method="post">
            <h1 >Prendre votre hospitalisation</h1> 
            <h3 >Choisissez un jour pour votre hospitalisation</h3> 
                <label for="chambre">chambre:</label>
                <select name="chambre" id="chambre"  >
                    <option value=""></option>
                    <?php foreach($chambres_dispo as $chambre_dispo):?>
                    
                        <option   value="<?php echo $chambre_dispo; ?>" 
                        <?php if($chambre_dispo==$id_chambre){echo "selected";} ?>> 
                            <?php echo "chambre ".$chambre_dispo?>
                        </option>
                    <?php endforeach ?>
                </select>
                <button type="submit" name="suivant">confirmer</button>
                <a href="date.php"> precdent</a>
            </form>
        </div>
    </div>
    
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>