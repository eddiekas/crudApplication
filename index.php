<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>CRUD!</title>
  </head>
  <body class="bg-info">

    <?php require_once 'connection.php';
          require_once 'join.php';
          require_once 'logout.php';
          ?>


          <?php
          session_start();

          if (isset($_SESSION["joins"]))
          {
            if ((time() - $_SESSION['last_login_timestamp']) > 60)
              {

                header('location:logout.php');
            }else{
            echo "Give me 60 sec";
            }
          }else {
            header('location:join.php');
          }




            ?>














    <?php

    if (isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

      <?php echo $_SESSION['message'];
            unset($_SESSION['message']);
       ?>

    </div>
  <?php endif; ?>


    <div class="container">



    <?php

    $mysqli = new mysqli('remotemysql.com', '6rSjKg7jkX', 'dLHskvqcXO', '6rSjKg7jkX') or die(mysqli_error($mysqli));
    //$mysqli = new mysqli('sql5.freesqldatabase.com', 'sql5438462', 'U7IJW7GnNi', 'sql5438462') or die(mysqli_error($mysqli));

    $result = $mysqli->query("SELECT * FROM employees") or die($mysqli->error);

    //pre_r($result);
    // pre_r($result->fetch_assoc());

    ?>

    <div class="row justify-content-center">
      <h1>cREATE, rEAD, uPDATE, dELETE</h1>

      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Roles</th>
            <th>Implement</th>
          </tr>
        </thead>

        <?php

        while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['roles']; ?></td>
          <td><a href="index.php?update=<?php echo $row['id']; ?>"
                  class="btn btn-success btn-sm">Update</a>
              <a href="connection.php?delete=<?php echo $row['id']; ?>"
                class="btn btn-danger btn-sm">Delete</a>

          </td>
        </tr>

      <?php endwhile; ?>

      </table>

    </div>



    <?php
    function pre_r($array){

      echo '<pre>';
      print_r($array);
      echo '</pre>';
    }
     ?>




<div class="row justify-content-center">

<form class="" action="connection.php" method="post">

  <input type="hidden" name="id" value="<?php echo $id; ?>">

<div class="form-row">

  <div class="form-group col-md-6">
  <label for="">Name: </label>
  <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" placeholder="Kindly Enter Name">
  </div>

  <div class="form-group col-md-6">
  <label for="">Role: </label>
  <input type="text" name="role" class="form-control" value="<?php echo $role; ?>"placeholder="Kindly Enter Role">
  </div>
</div>


  <div class="form-group">

    <?php if ($updatesave == true):  ?>
      <button type="submit" class="btn btn-primary" name="finalUpdate">Update</button>
    <?php else: ?>

  <button type="submit" class="btn btn-info" name="save">Save</button>
  <?php endif; ?>
  </div>


</form>
</div>



</div>





    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
