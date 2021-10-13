<?php

session_start();


//$mysqli = new mysqli('localhost', '', '', '') or die(mysqli_error($mysqli));
$mysqli = new mysqli('remotemysql.com', '6rSjKg7jkX', 'dLHskvqcXO', '6rSjKg7jkX') or die(mysqli_error($mysqli));
//$mysqli = new mysqli('sql5.freesqldatabase.com', 'sql5438462', 'U7IJW7GnNi', 'sql5438462') or die(mysqli_error($mysqli));


$id = 0;
$updatesave = false;
$name = '';
$role = '';




if (isset($_POST['save']) && !empty($_POST['name']) && !empty($_POST['role'])) {
  // code...
  $name = $_POST['name'];
  $role = $_POST['role'];


  $mysqli->query("INSERT INTO employees (name, roles) VALUES('$name', '$role')")
  or die($mysqli->error());


  // $_SESSION['name'] = $_POST['name'];
  // $_SESSION['last_login_timestamp'] = time();

  $_SESSION['message'] = "Record has been saved!";
  $_SESSION['msg_type'] = "info";

  header("location:index.php");

}elseif (isset($_POST['save'])) {

  $name = '';
  $role = '';
  $_SESSION['message'] = "Input Record!";
  $_SESSION['msg_type'] = "danger";
  header("location:index.php");

}


if (isset($_GET['delete'])) {
  // code...
  $id = $_GET['delete'];
  $mysqli->query("DELETE FROM employees WHERE id=$id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been deleted!";
  $_SESSION['msg_type'] = "danger";

  header("location:index.php");

}

if (isset($_GET['update'])) {
  // code...
  $id = $_GET['update'];
  $updatesave = true;
  $result = $mysqli->query("SELECT * FROM employees WHERE id=$id") or die($mysqli->error());
  if (!empty($result)) {
    // code...
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $role = $row['roles'];



  }

}


if (isset($_POST['finalUpdate'])) {
  // code...

  $id = $_POST['id'];
  $name = $_POST['name'];
  $role = $_POST['role'];

  $mysqli->query("UPDATE employees SET name = '$name', roles = '$role' WHERE id = $id") or die($mysqli->error());

  $_SESSION['message'] = "Record has been Updated";
  $_SESSION['msg_type'] = "primary";

  header('location:index.php');

}



 ?>
