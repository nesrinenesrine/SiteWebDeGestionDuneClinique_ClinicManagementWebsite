
<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
if (!isset($_SESSION['userId']) )
{
    header("location:login.php");
    exit();
}
else{
    include '../../inc/db.php';
    $id_medecin=$_SESSION['userId'];

    $sql_specialite ='SELECT *
        FROM specialite';
    if (mysqli_query($conn,$sql_specialite))
    {
        $result = mysqli_query($conn,$sql_specialite);
        $specialites=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }

    $sql ="SELECT * FROM medcin WHERE medcin.id_medcin='$id_medecin'";
    if (mysqli_query($conn,$sql))
    {
        $result = mysqli_query($conn,$sql);
        $medecin=mysqli_fetch_all($result, MYSQLI_ASSOC);
        $medecin=$medecin[0];
        
    }else 
    { 
        echo ("error" . mysqli_error($conn) );
    }
    $nom="";
    $prenom="";
    $username="";
    $email="";
    $telephone="";
    $spe= $medecin['id_specialite'];
    $err_nom="";
    $err_prenom="";
    $err_username="";
    $err_tel="";
    $err_email="";

    if(isset($_POST['submit']))
    {
        $nom        =htmlspecialchars($_POST['nom']);
        $prenom     =htmlspecialchars($_POST['prenom']);
        $username   =htmlspecialchars($_POST['username']);
        $spe=htmlspecialchars($_POST['specialite']);
        $telephone  =htmlspecialchars($_POST['telephone']);
        $email      =htmlspecialchars($_POST['email']);

        
        if (!preg_match("/^[a-zA-Z-' '-']*$/",$nom))
        {
            $err_nom='syntaxe invalide';
        }elseif (!preg_match("/^[a-zA-Z-' '-']*$/",$prenom))
        {
            $err_prenom = 'syntaxe invalide';
        }
        elseif (!preg_match("/^[a-zA-Z1-9-' '-']*$/",$username))
        {
            $err_username='la syntex valable du username est des lettre etles chifre et des espace blac';
        }elseif(!preg_match("/[0-9]*/",$telephone))
        {
            $err_tel="FORMA INCORET";
        }
        elseif(strlen($telephone)<>10)
        {
            $err_tel="FORMA INCORET2";
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $err_email="ERROR:format invalide d'email ";
        }
        else{
            $sql_update="UPDATE `medcin` SET 
            `user_name_medcin`='$username',`nom_medcin`='$nom',`prenom_medcin`='$prenom',
            `telephone_medcin`='$telephone',`email_medcin`='$email',`id_specialite`='$spe',`id_service`='$spe' 
            WHERE medcin.id_medcin='$id_medecin'";

            if(mysqli_query($conn,$sql_update))
            {
                header("location:profile_medcin.php");
                exit();
            }
            else
            {
                echo 'ERROR' . mysqli_error($conn);
            }
        }
    }
}
?>

