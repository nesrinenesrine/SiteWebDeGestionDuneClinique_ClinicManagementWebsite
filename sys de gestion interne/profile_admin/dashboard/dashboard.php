<?php
$conn=mysqli_connect("localhost:3307" , "root" , "" ,"pfe4");

if (!$conn ){
    die ("Failed to connect to MySQL: " . mysqli_connect_error());
}
//graphe 1
$sql_famale = "SELECT * FROM `patient` WHERE patient.sexe ='femele';";

$result =mysqli_query ($conn , $sql_famale);
$numbreF=mysqli_num_rows($result);

$sql_male = "SELECT * FROM `patient` where patient.sexe='male';";
$result =mysqli_query ($conn , $sql_male);
$numbreM=mysqli_num_rows($result);
//ghraphe 2
$sql_services = "SELECT * FROM `service`";
$result =mysqli_query ($conn , $sql_services);
$services =mysqli_fetch_all($result, MYSQLI_ASSOC);
   $ser =array ();
   $numchom= array ();
foreach ($services as $service) :
    $ser[] = $service ["nom_service"];
    $numbchom[] = $service ["nb_chambre_dispo"];
endforeach;

//graphe 3

$sql_empl = "SELECT emploi FROM `patient`";
$result =mysqli_query ($conn , $sql_empl);
$emplois =mysqli_fetch_all($result, MYSQLI_ASSOC);
  $em = array ();
foreach ($emplois as $emploi) :
    $em[] = $emploi["emploi"];
    
endforeach; 

$j=0;
$em_num =array();
$em_emp =array ();
for ($i=0 ; $i<count($em) ;$i++){
    $id =$em [$i];
    $equal=0;
    $k=0;
    if ($i==0) {
        $sql_num ="SELECT * FROM `patient` WHERE patient.emploi ='$id'";
        $result =mysqli_query ($conn , $sql_num);
        $em_num[$j]=mysqli_num_rows($result);
        $em_emp[$j]=$id ;
        $j++;
    }
    while ($k<count($em_emp) && $equal==0){
        if ($id == $em_emp[$k]){
            $equal=1;
        }else {$k++;}
    }
    if ($equal==0){
        $sql_num ="SELECT * FROM `patient` WHERE patient.emploi ='$id'";
        $result =mysqli_query ($conn , $sql_num);
        $em_num[$j]=mysqli_num_rows($result);
        $em_emp[$j]=$id ;
        $j++;
    }
    
    
   
    

    

}


//graphe 4 ville
$sql_empl = "SELECT ville FROM `patient`";
$result =mysqli_query ($conn , $sql_empl);
$villes =mysqli_fetch_all($result, MYSQLI_ASSOC);
  $vi = array ();
foreach ($villes as $ville) :
    $vi[] = $ville["ville"];
    
endforeach; 

$j=0;
$vi_num =array();
$vi_emp =array ();

for ($i=0 ; $i<count($vi) ;$i++){
    $id =$vi [$i];
    $equal=0;
    $k=0;
    if ($i==0) {
        $sql_num ="SELECT * FROM `patient` WHERE patient.ville ='$id'";
        $result =mysqli_query ($conn , $sql_num);
        $vi_num[$j]=mysqli_num_rows($result);
        $vi_emp[$j]=$id ;
        $j++;
    }
    while ($k<count($vi_emp) && $equal==0){
        if ($id == $vi_emp[$k]){
            $equal=1;
        }else {$k++;}
    }
    if ($equal==0){
        $sql_num ="SELECT * FROM `patient` WHERE patient.ville ='$id'";
        $result =mysqli_query ($conn , $sql_num);
        $vi_num[$j]=mysqli_num_rows($result);
        $vi_emp[$j]=$id ;
        $j++;
    }

}

//graphe 5 


$sql_age = "SELECT age FROM `patient`";
$result =mysqli_query ($conn , $sql_age);
$ages =mysqli_fetch_all($result, MYSQLI_ASSOC);
  $ag = array ();
foreach ($ages as $age) :
    $ag[] = $age["age"];
    
endforeach; 

$j=0;
$ag_num =array();
$ag_emp =array ();

for ($i=0 ; $i<count($ag) ;$i++){
    $id =$ag [$i];
    $equal=0;
    $k=0;
    if ($i==0) {
        $sql_num ="SELECT * FROM `patient` WHERE patient.age ='$id'";
        $result =mysqli_query ($conn , $sql_num);
        $ag_num[$j]=mysqli_num_rows($result);
        $ag_emp[$j]=$id ;
        $j++;
    }
    while ($k<count($ag_emp) && $equal==0){
        if ($id == $ag_emp[$k]){
            $equal=1;
        }else {$k++;}
    }
    if ($equal==0){
        $sql_num ="SELECT * FROM `patient` WHERE patient.age ='$id'";
        $result =mysqli_query ($conn , $sql_num);
        $ag_num[$j]=mysqli_num_rows($result);
        $ag_emp[$j]=$id ;
        $j++;
    }
    

    

}

//graphe 6 
$sql_rdv = "SELECT date FROM `rdv`";
$result =mysqli_query ($conn , $sql_rdv);
$rdvs =mysqli_fetch_all($result, MYSQLI_ASSOC);
$rd= array ();
foreach ($rdvs as $rdv) :
   
$d =strtotime($rdv["date"]);
$jour = date('l',$d);
    $rd[] = $jour;
    
endforeach;
$j=0;
$rd_numb =array();
$count=0;

    
//les nombres de patinet 

$sql_pat = "SELECT * FROM `patient` ";

$result =mysqli_query ($conn , $sql_pat);
$numbreP=mysqli_num_rows($result);

//les nombre de medcin

$sql_med = "SELECT * FROM `medcin` ";

$result =mysqli_query ($conn , $sql_med);
$numbreMed=mysqli_num_rows($result);

//les nombres de operation 
$sql_op = "SELECT * FROM `operation`";

$result =mysqli_query ($conn , $sql_op);
$numbreop=mysqli_num_rows($result);

//les nombres de hos
$sql_hosp = "SELECT * FROM `hospitalisation`";

$result =mysqli_query ($conn , $sql_hosp);
$numbrehosp=mysqli_num_rows($result);


//feedback
$sql_feed = "SELECT feed FROM `feedback`";
$result =mysqli_query ($conn , $sql_feed);
$feedbacks =mysqli_fetch_all($result, MYSQLI_ASSOC);
  $feed = array ();
foreach ($feedbacks as $feedback) :
    $feed[] = $feedback["feed"];
endforeach; 
$j=0;
$feed_numb =array();
$feed_emp =array ();
for ($i=0 ; $i<count($feed) ;$i++){
    $id =$feed[$i];
    $equal=0;
    $k=0;
    if ($i==0) {
        $sql_num ="SELECT * FROM `feedback` WHERE feedback.feed ='$id'";
        $result =mysqli_query($conn , $sql_num);
        $feed_num[$j]=mysqli_num_rows($result);
        $feed_emp[$j]=$id ;
        $j++;
    }
    while ($k<count($feed_emp) && $equal==0){
        if ($id == $feed_emp[$k]){
            $equal=1;
        }else {$k++;}
    }
    if ($equal==0){
        $sql_num ="SELECT * FROM `feedback` WHERE feedback.feed ='$id'";
        $result =mysqli_query ($conn , $sql_num);
        $feed_num[$j]=mysqli_num_rows($result);
        $feed_emp[$j]=$id ;
        $j++;
    }
}

?>
