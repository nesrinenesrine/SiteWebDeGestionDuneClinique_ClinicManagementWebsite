<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
}
include '../inc/db.php';
if (!isset($_SESSION['userId']) )
{
    header("location:login.php");
    exit();
}
else
{
    $id= $_SESSION['userId'];
    $sql_patient="SELECT * FROM `patient` WHERE   patient.id_patient ='$id'";
    if(mysqli_query($conn,$sql_patient))
    {
        $result = mysqli_query($conn,$sql_patient);
        $user=mysqli_fetch_all($result, MYSQLI_ASSOC);
    }else 
    { 
        echo ("error" . mysqli_error($conn));
    }

    $err_prenom="";
    $err_nom="";
    $err_email="";
    $err_tel="";
    $err_username="";
    $nom=$user[0]['nom'];
    $prenom=$user[0]['prenom'];
    $username=$user[0]['user_name'];
    $tel=$user[0]['telephone'];
    $email=$user[0]['email'];
    $emploi=$user[0]['emploi'];
    $ville=$user[0]['ville'];
    $adress=$user[0]['adresse'];
    $sexe=$user[0]['sexe'];

    if(isset($_POST['submit']))
    {
        $nom        =htmlspecialchars($_POST['nom']);
        $prenom     =htmlspecialchars($_POST['prenom']);
        $username   =htmlspecialchars($_POST['username']);
        $tel         =htmlspecialchars($_POST['telephone']);
        $email      =htmlspecialchars($_POST['email']);
        $adress     =htmlspecialchars($_POST['adress']);
        $ville      =htmlspecialchars($_POST['ville']);
        $emploi     =htmlspecialchars($_POST['emploi']);
        $sexe       = test_input($_POST["sexe"]);
    
        if (!preg_match("/^[a-zA-Z-' '-']*$/",$nom))
        {
            $err_nom='syntaxe invalide';
        }elseif (!preg_match("/^[a-zA-Z-' '-']*$/",$prenom))
        {
            $err_prenom = 'syntaxe invalide';
        }elseif (!preg_match("/^[a-zA-Z1-9-' '-']*$/",$username))
        {
            $err_username='la syntex valable du username est des lettre etles chifre et des espace blac';
        }
        elseif(!preg_match("/[0-9]*/",$tel))
        {
            $err_tel="FORMA INCORET";
        }
        elseif(strlen($tel)<>10)
        {
            $err_tel="FORMA INCORET2";
        }
        elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $err_email="ERROR:format invalide d'email ";
        }
        else
        {
            $sql_modif="UPDATE `patient` SET `user_name`='$username',`nom`='$nom',`prenom`='$prenom',`sexe`='$sexe',
            `telephone`='$tel',`email`='$email',`adresse`='$adress',`ville`='$ville',`emploi`='$emploi' WHERE  patient.id_patient='$id'";

            if(mysqli_query($conn,$sql_modif))
            {
                
                header("location:profile.php");
                exit();
            }
            else
            {
                echo 'ERROR' . mysqli_error($conn);
            }
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

