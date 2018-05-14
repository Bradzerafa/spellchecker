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
$word = ucfirst($_POST['wordCheck']);

// Check if word exists in the DB.

$wordCheck = $db -> prepare("SELECT word FROM english");
$wordCheck -> execute();
$result = $wordCheck->fetchAll(PDO::FETCH_COLUMN);


$match = 0;



foreach ($result as $words){
  $words = ucfirst($words);
  if ($word === $words){
    echo "This word is spelt correctly";
    $match = 1;
  }
}

if ($match === 0){
  $similarWords = array();
foreach ($result as $words){
   similar_text(ucfirst($word), ucfirst($words), $percent);
      if ($percent >= 85.00){
      array_push($similarWords, $words);
        $match = 1;
    }
  }
}

if (!empty($similarWords)){
    echo "Did you mean: </br>";
    $num = 0;
    while ($num < count($similarWords)){
      echo $similarWords[$num] . '</br>';
      $num++;
    }
  }



 if($match == 0){
   echo "Sorry, this word is not in the database.";
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
