<?php require_once('config.php') ?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    body{
      background: yellow;
    }
      
      

    </style>
    <?php include('includes/head_section.php'); ?>
  </head>
  <body>
<?php  include( ROOT_PATH . '/includes/navbar.php');?>

<form id="form" method="post" action="getweather.php">

<div class="hell">
  <div class="form-group">
        <select name="id" id="id" class="form-control">
        <option value="2960"></option>
        <option value="2960"></option>
        <option value="2960">Andhra Pradesh</option>
        <option value="2960">Andhra Pradesh</option>
        <option value="2960">Andhra Pradesh</option>
    </select>
  <div class="form-group">
  <input type="submit" name="submit" value="Submit">
  </div>
</form>
</div>



<?php  include( ROOT_PATH . '/weather/weather.php'); ?>

  </body>
</html>
<?php include( ROOT_PATH . '/includes/footer.php') ?>