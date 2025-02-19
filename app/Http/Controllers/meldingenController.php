<?php

//Variabelen vullen
$attractie = $_POST['attractie'];
$type = $_POST['type'];
$capaciteit = $_POST['capaciteit'];
if(isset($_POST['prioriteit']))
{$prioriteit = 1;}
else
{$prioriteit = 0;}
$melder = $_POST['melder'];
$overig = $_POST['overig'];

//1. Verbinding
require_once '../../../config/conn.php';

//2. Query (om alles in te vullen wat niet NULL kan zijn)
$query = "INSERT INTO meldingen (attractie, type, capaciteit, prioriteit, melder, overige_info)
VALUES(:attractie, :type, :capaciteit, :prioriteit, :melder, :overige_info)";

//3. Prepare
$statement = $conn->prepare($query);

//4. Execute
$statement->execute([
    ":attractie" => $attractie,
    ":type" => $type,
    ":capaciteit" => $capaciteit,
    ":prioriteit" => $prioriteit,
    ":melder" => $melder,
    ":overige_info" => $overig
]);

//Errorinoes
if(empty($attractie))
{
    $errors[] = "Vul de attractie-naam in.";
}
if(empty($type))
{
    $errors[] = "Kies de type.";
}
if(!is_numeric($capaciteit)) 
{
    $errors[] = "Vul voor capaciteit een geldig getal in.";
}
if(empty($melder))
{
    $errors[] = "Vul de melder's naam in.";
}
if(isset($errors))
{
 var_dump($errors);
 die();
}

header("Location: ../../../resources/views/meldingen/index.php?msg=Melding opgeslagen");
