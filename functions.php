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

$wordCheck = $db -> prepare("SELECT word FROM english");
$wordCheck -> execute();
$result = $wordCheck->fetchAll(PDO::FETCH_COLUMN);

foreach ($result as $words){
   similar_text($word, $words, $percent);
      if ($percent >= 80.00){
        echo $words . '</br>';
    }



 }



/*

if (!isset($result[0]['word'])){

  foreach ($result as $words){
     similar_text($word, $words, $percent);
     if ($percent >= 95.00){
       $didYouMean = $words;
     }

     echo $didYouMean;
   }


} else {
  $result = ucfirst($result[0]['word']);

  if($result === ucfirst($word)){
    echo "word does exist";
  }

}

*/





}
