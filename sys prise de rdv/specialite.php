<?php 
session_start();
include '../inc/db.php';
$id=$_SESSION['id_specialite'];
$sql="SELECT * FROM `specialite` WHERE specialite.id_specialite='$id'";
if (mysqli_query($conn,$sql))
{
    $result = mysqli_query($conn,$sql);
    $specialite=mysqli_fetch_all($result, MYSQLI_ASSOC);
    $nom_specialite=$specialite[0]['nom_specialite'];
    $disc = $specialite[0]['disc_specialite'];
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style-home2.css">
    <title><?php echo $nom_specialite; ?></title>
</head>
<body>
    <nav>
            <div class="logo">
                <a href="index.php"> <img src="../img/CLINIQUE DE CONFORT.svg" alt=""></a>
            </div>
            <i class="uil uil-bars" id="open-menu"></i> 
    </nav>
    <div class="backgound1">

        <div class="containre_header">
            <form action="specialite.php" method="post">
                <p><?php echo $disc ;?></p>
            </form>
        </div>
</div>
</body>
</html>