<?php 
session_start();
include '../../inc/db.php';
$id_medcin=$_SESSION['id_medcin']; 
$id_patient=$_SESSION['id_patient'];
$date=$_SESSION['date'];
$heur_deb=$_SESSION['heur_deb'];
$heur_fin=$_SESSION['heur_fin'];
$date = $_SESSION['date'];
$err="";
$id_demande_op = $_SESSION['id_demande_op'];

$sql_bloq="SELECT * FROM bloq";
if (mysqli_query($conn,$sql_bloq))
{
    $result = mysqli_query($conn,$sql_bloq);
    $bloqs=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}


$sql_bloq_occupe="SELECT * FROM etat_bloq WHERE (etat_bloq.date='$date')
                and(('$heur_deb' BETWEEN etat_bloq.heur_deb and etat_bloq.heur_fin) 
                or ('$heur_fin' BETWEEN etat_bloq.heur_deb and etat_bloq.heur_fin)
                or ('$heur_deb' < etat_bloq.heur_deb and '$heur_fin'> etat_bloq.heur_fin) )";

if (mysqli_query($conn,$sql_bloq_occupe))
{
    $result = mysqli_query($conn,$sql_bloq_occupe);
    $bloqs_occupe=mysqli_fetch_all($result, MYSQLI_ASSOC);
}else 
{ 
    echo ("error" . mysqli_error($conn) );
}



$bloq_dispo=array();
foreach ($bloqs as $bloq)
{
    $b=true;
    foreach($bloqs_occupe as $bloq_occupe)
    {
        if($bloq['id_bloq']==$bloq_occupe['id_bloq'])
        {
            $b=false;
        }
    }
        
    if($b==true)
    {
        array_push($bloq_dispo,$bloq);
    }
}

$bool=false;
if(count($bloq_dispo)==0)
{
    echo "aucun bloque est disponible pour cette date et cette heur";
}else
{
    $bool= true;
}

if (isset($_POST['suivant'])) 
{
    $id_bloq=$_POST['id_bloq'];
    if(empty($id_bloq))
    {
        $err="vous dever choisire un bloque pour loperation";
    }
    else{
        $sql="INSERT INTO operation (`id_medcin`, `id_patient`, `id_bloq`, `date`, `heur`,`heur_fin`)
            VALUES('$id_medcin','$id_patient','$id_bloq','$date','$heur_deb','$heur_fin') ";
        if (mysqli_query($conn,$sql))
        {
            
            $sql_update="UPDATE `demmande_operataion` SET `etat`= 1 WHERE id_demmande='$id_demande_op'";
            if (mysqli_query($conn,$sql_update))
            {
                
                header("location:../profile_admin/profil_admin.php");
                exit();
            }
            else 
            { 
                echo ("error" . mysqli_error($conn) );
            }

            
            exit();
            
        }else 
        { 
            echo ("error" . mysqli_error($conn) );
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
    <link rel="stylesheet" href="./style-operation.css">
    <title>Document</title>
</head>
<body>
<div class="profile">
       <a href="../profile_admin/profil_admin.php"><span class="icon"><ion-icon name="enter-outline"></ion-icon><span class="title">Mon compte</span></span></a>
   
 </div>
<div class = "box">
         <div class="img"><img src="../../img/logo-of-profile.svg" alt=""></div>
        <div class="rendez op">
            
                       
            
                    <?php if($bool==true):?>
                        <h1 >Organisation d'une Opération</h1> 
                        <h3 >Choisissez bloc pour cette Opération</h3>
                        <form action="bloq.php"  method="POST">
                            <select name="id_bloq" id="id_bloq"   onchange="javascript:submit(this);">
                                <option></option>
                                <label for=""> bloq:</label>
                                <?php foreach($bloq_dispo as $bloq_d) :?>
                                    <option  value="<?php echo $bloq_d['id_bloq'];?>"  <?php if(isset($_POST['id_bloq'])){if($_POST['id_bloq']==$bloq_d['id_bloq']){echo "selected";}} ?> >
                                        <?php echo  "bloque"." ". $bloq_d['id_bloq']; ?>
                                    </option>
                                <?php endforeach;?> 
                            </select>
                            <button type="submit" name="suivant">Confirmer</button>
                            <a href="http:heur.php"> Précédent</a>
                        </form>
                    <?php endif ;?>
                    <span><?php echo $err;?></span>
    
   </div>
</div>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>