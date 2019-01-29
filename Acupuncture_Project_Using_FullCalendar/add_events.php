<?php
// Values received via ajax
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$description = $_POST['description'];

// connection to the database
try 
{
    $bdd = new PDO('mysql:host=localhost;dbname=acupuncture', 'root', '');
} 
catch (Exception $e) 
{
    exit($e);
}

// insert the records
$sql = "INSERT INTO events (title, start, end, description) VALUES (:title, :start, :end, :description )";
$q = $bdd->prepare($sql);
$q->execute(array(':title' => $title, ':start' => $start, ':end' => $end, ':description' => $description));
?>