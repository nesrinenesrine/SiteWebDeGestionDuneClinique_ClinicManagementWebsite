<?php 
session_start();
include '../../../inc/db.php';
$date=$_SESSION['date_modif'];
$date_de_sortie=$_SESSION['nv_date_sortie'];
$id_chambre=$_SESSION['nv_chambre'];
$id_lit=$_SESSION['id_lit'];
$id=$_SESSION['id_hospitalisatation'];

$sql_lit_occupe="SELECT * FROM `lit` 
JOIN etat_chambre ON 
(etat_chambre.id_lit=lit.id_lit) AND 
(etat_chambre.id_chambre=lit.id_chambre) AND 
(('$date' BETWEEN etat_chambre.date AND etat_chambre.date_sortie) OR 
('$date_de_sortie' BETWEEN etat_chambre.date AND etat_chambre.date_sortie))
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
    $id_lit=$_POST['lit'];
    $sql_update="UPDATE `hospitalisation` SET 
    `id_chambre`='$id_chambre',`id_lit`='$id_lit',`date_entre`='$date',`date_sortie`='$date_de_sortie' 
    WHERE hospitalisation.id_hospitalisation";
    if(mysqli_query($conn,$sql_update))
    {
        echo "hello";
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
    <link rel="stylesheet" href="../../organiser_hospitalisation/style-hos.css">
    <title>lit</title>
</head>
<body>
<div class="profile">
       <a href="../profile-chef.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
    
    </div>
    <div class = "box">
         <div class="img"><img src="../../../img/CLINIQUE DE CONFORT.svg" alt=""></div>
         <div class="rendez">
         <h1 >Prendre votre hospitalisation</h1> 
          <h3 >Choisissez un jour pour votre hospitalisation</h3> 
                <form action="lit.php" method="POST">
                    <label for="id_lit">lit</label>
                    <select name="lit" id="lit" >
                        <option ></option>
                        <?php foreach($lits as $lit):?>
                            <option value="<?php echo $lit['id_lit']; ?>" 
                            <?php if($lit['id_lit']==$id_lit){echo "selected";} ?>> 
                                <?php echo "lit".$lit['id_lit'] ;?>
                            </option>
                        <?php endforeach ?>
                    </select>
                    <button type="submit" name="suivant">confirmer</button>
                </form>
                </form>
         </div>
    </div>
    
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>