<?php require_once('dbconnect.php');

if(isset($_POST['check'])){
$word = ucfirst($_POST['wordCheck']);
$match = 0;

$wordCheck = $db -> prepare("SELECT word FROM english");
$wordCheck -> execute();
$result = $wordCheck->fetchAll(PDO::FETCH_COLUMN);


// Checks if word submitted is in the database.
foreach ($result as $words){
  $words = ucfirst($words);
    if ($word === $words){
      echo "This word is spelt correctly";
      $match = 1;
    }
}

//Checks for words with 85% match to the submitted word.
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

// Echos words that are similar.
if (!empty($similarWords)){
  echo "Did you mean: </br>";
  $num = 0;
    while ($num < count($similarWords)){
      echo $similarWords[$num] . '</br>';
      $num++;
    }
}

//Lets user know if the word is not found in the database and their are no similar words.
 if($match == 0){
   echo "Sorry, this word is not in the database.";
 }

}
