<?php


$db=@ mysqli_connect('localhost', 'root', 'password', 'web')
or die ('unable to connect to server');
mysqli_query($db, 'set names utf8');
if(mysqli_connect_errno()){
  echo "Error: cannot connect to database";
  exit;
}
?>
