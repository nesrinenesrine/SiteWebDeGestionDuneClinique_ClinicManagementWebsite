<?php 

session_start();
include '../../../inc/db.php';
$id=$_SESSION['id_hospitalisatation'];

$sql_hospi="SELECT * FROM `hospitalisation` WHERE  hospitalisation.id_hospitalisation='$id'";
if (mysqli_query($conn,$sql_hospi))
{
    $result = mysqli_query($conn,$sql_hospi);
    $hospitalisation=mysqli_fetch_all($result, MYSQLI_ASSOC);
    $date_entre=$hospitalisation[0]['date_entre'];
    $_SESSION['date_sortie']=$hospitalisation[0]['date_sortie'];
    $_SESSION['id_lit']=$hospitalisation[0]['id_lit'];
    $_SESSION['id_chambre']=$hospitalisation[0]['id_chambre'];
    $_SESSION['id_service']=$hospitalisation[0]['id_service'];
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

if(isset($_POST['suivant']))
{
    $_SESSION['date_modif'] = $_POST['date'];
    header("location:date_sortie.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../organiser_hospitalisation/style-hos.css">
    <title>date de hospitalissation</title>
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
            <form action="date.php" method="POST">
                <label for="date"> date:</label>
                <input type="date"  name="date"  id="date" value="<?php echo $date_entre; ?>" >
                <button type="submit" name="suivant"> suivant</button>
            </form>
            </div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>