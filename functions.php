<?php
require_once('dbconnect.php');

/*

 - Take word from input.
 - Check if word exists in the DB.
 - If it does then respond that it is the correct spelling.
 - If not find top 3 words similar to it and respond "Did you mean".

*/


// Take word from input.
if (isset($_POST['check'])){
$word = $_POST['wordCheck'];

// Check if word exists in the DB.

$wordCheck = $db -> prepare("SELECT word FROM english WHERE word = '$word' ");
$wordCheck -> execute();
$result = $wordCheck->fetchAll(PDO::FETCH_ASSOC);

if (!isset($result[0]['word'])){
  echo 'Sorry, that word does not exist in the database';
} else {
  $result = ucfirst($result[0]['word']);

  if($result === ucfirst($word)){
    echo "word does exist";
  }

}





}
