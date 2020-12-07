<?php
// Create connection
$connect=mysqli_connect('localhost', 'root', '', 'e-shopping');
//$connect=mysqli_connect('localhost', 'id15210079_caveshopping', 'u>E8M&#gOP1&WN)V', 'id15210079_cave');
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
  }
 // echo "Connected successfully";