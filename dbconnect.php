<?php

ini_set('display_errors', 'On');
$db = new PDO("mysql:host=localhost; dbname=spellchecker", "root", "root");
$db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
