<?php

function db_connect($username, $password, $dbName){
  $server = 'localhost';

  $mysqli = new mysqli($server, $username, $password, $dbName);
  if ($mysqli->connect_error){
    echo $mysqli->connect_error;
    exit();
  }else{
    $mysqli->set_charset("utf-8");
  }
  return $mysqli;
}
?>
