<?php

$err_nom="";
$err_prenom="";
$err_username="";
$err_sexe="";
$err_date="";
$err_tel="";
$err_email="";
$err_adress="";
$err_ville="";
$err_emploi="";
$err_pass="";

if (isset($_POST['submit'])) 
{
    $nom            =htmlspecialchars($_POST['nom']);
    $prenom         =htmlspecialchars($_POST['prenom']);
    $username       =htmlspecialchars($_POST['username']);
    $date           =htmlspecialchars($_POST['age']);
    $telephone      =htmlspecialchars($_POST['telephone']);
    $email          =htmlspecialchars($_POST['email']);
    $adress         =htmlspecialchars($_POST['adress']);
    $ville          =htmlspecialchars($_POST['ville']);
    $emploi         =htmlspecialchars($_POST['emploi']);
    $password1      =htmlspecialchars($_POST['password1']);
    $password2      =htmlspecialchars($_POST['password2']);
    $password_code  =password_hash($_POST['password2'],PASSWORD_DEFAULT);

    if(empty($nom)) 
    { 
        $err_nom="vous devez saisir votre nom";
    }elseif (!preg_match("/^[a-zA-Z-' '-']*$/",$nom))
    {
        $err_nom='syntaxe invalide';
    }elseif(empty($prenom))
    {
        $err_prenom= "vous devez saisir votre prénom";
    }elseif (!preg_match("/^[a-zA-Z-' '-']*$/",$prenom))
    {
        $err_prenom = 'syntaxe invalide';
    }elseif(empty($username))
    {
        $err_username='veuillez introduisez votre nom d utilisatuer ';
    }elseif (!preg_match("/^[a-zA-Z1-9-' '-']*$/",$username))
    {
        $err_username='la syntex valable du username est des lettre etles chifre et des espace blac';
    }
    elseif(email_existe($username,$conn))
    {
        $err_username="saisiser un autre nom d'uilisateur :vous pouvez ajouter des chifre ";
    }
    elseif(empty($_POST["sexe"]))
    {
        $err_sexe='veuillez choisire votre sexe';
    }
    elseif(empty($date))
    {
        $err_date='veuillez introduisez votre date de nessance';
    }elseif(empty($telephone))
    {
        $err_tel="NUM VIDE";   
    }elseif(!preg_match("/[0-9]*/",$telephone))
    {
        $err_tel="FORMA INCORET";
    }
    elseif(strlen($telephone)<>10)
    {
        $err_tel="FORMA INCORET2";
    }
    elseif(empty($email))
    {
        $err_email="vous devez saisire un email";
    }
    elseif(email_existe($email,$conn))
    {
        $err_email="vous aver deja un compte";
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        $err_email="ERROR:format invalide d'email ";
    }
    elseif(empty($adress))
    {
        $err_adress="vous devez saosore votre adress";
    }
    elseif(empty($ville))
    {
        $err_ville='ERROR:veuillez introduisez votre ville';
    }
    elseif (!preg_match("/^[a-zA-Z-' '-']*$/",$ville))
    {
        $err_ville='ERROR:la syntex valable du ville est des lettre et des espace blac';
    }
    elseif(empty($emploi))
    {
        $err_emploi="vous dever saisire votre emploi";
    }
    elseif(empty($password1))
    {
        $err_pass='ERROR:veuillez introduisez un mot de passe';
    }
    elseif(strlen($password1) < 8)
    {
        $err_pass="choisire un mot de passe contiet au mion 8 carr";
    }
    elseif(!check_mdp_format($password1))
    {
        $err_pass="le mot de passe doit contenire au moin un carr maj et des chiffre";
    }
    elseif(empty($password2))
    {
        $err_pass='veuillez confirmer votre mot de passe';
    }
    elseif ($password1<>$password2) 
    {
        $err_pass= 'reconfirmer votre mot de passe';
    }
    else{
        $sexe = test_input($_POST["sexe"]);
        $age=age($date);
        $sql = "INSERT INTO patient(user_name, mot_de_passe , nom ,prenom , sexe , age , telephone,email,adresse ,ville , emploi )
        VALUES('$username','$password_code','$nom','$prenom','$sexe','$age','$telephone','$email','$adress','$ville','$emploi') ";
                                        
        if(mysqli_query($conn,$sql))
        {
            header("location:login.php");
            exit();
        }
        else
        {
            echo 'ERROR' . mysqli_error($conn);
        }
    }
}  

function email_existe($email,$conn)
{
    $sql_verfie_emial="SELECT * FROM `patient` WHERE patient.email='$email' or patient.user_name='$email'";
    if(mysqli_query($conn , $sql_verfie_emial))
    {
        $result =mysqli_query($conn,$sql_verfie_emial);
        $row =mysqli_num_rows ($result);
        if($row > 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        echo 'ERROR' . mysqli_error($conn);
    }
}

function test_input($data) 
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


function check_mdp_format($password)
{
	$majuscule = preg_match('@[A-Z]@', $password);
	$minuscule = preg_match('@[a-z]@', $password);
	$chiffre = preg_match('@[0-9]@', $password);
	
	if(!$majuscule || !$minuscule || !$chiffre )
	{
		return false;
	}
	else {return true;}
}


function age($date) 
{ 
   $age = (int)date('Y') - (int)$date ; 
   if (date('md') < date('md', strtotime($date))) 
    { 
       return $age - 1; 
    } 
   return $age; 
} 