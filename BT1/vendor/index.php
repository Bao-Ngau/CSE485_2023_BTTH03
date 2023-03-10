<?php
require_once("../Email/EmailSender.php");
require_once("../Email/MyEmailServer.php");

if(isset($_POST['email'])&&isset($_POST['pass'])){
    $code = rand(100000,999999);
    $email = $_POST['email']; 
    $emailServer = new MyEmailServer();
    $emailSender = new EmailSender($emailServer);
    $emailSender->send($email,"Mã code của bạn", ' <div style="text-align: center;">Mã xác của bạn:<br/><h1 style="color: red; font-size: 24px;">' . $code . '</h1></div>');
 }
 ?>
 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Demo</title>
</head>
<body>
<form class="row g-3" action="" method="post">
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4"name="email">
  </div>
  <div class="col-md-6">
    <labe+8l for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" id="inputPassword4"name="pass">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Sign in</button>
  </div>
</form>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</html>
