<?php

$nom = 'Kharchi';
$prenom = 'Djaouida';
$initiales = initials($nom.' '.$prenom);
var_dump($initiales);
$_SESSION['initiales']=$initiales;

echo "<h1>". $_SESSION['initiales']."</h1>";
function initials($nom) {
    preg_match('/(?:\w+\. )?(\w+).*?(\w+)(?: \w+\.)?$/', $nom, $result);
   
    // var_dump(strtoupper($result[1][0].$result[2][0]));
    return strtoupper($result[1][0].$result[2][0]);
}

