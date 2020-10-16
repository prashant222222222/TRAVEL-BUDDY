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
      #videos{
        margin: auto;
      }
    </style>
    <?php include('includes/head_section.php'); ?>
  </head>
  <body>
<?php  include( ROOT_PATH . '/includes/navbar.php');?>

<?php  include( ROOT_PATH . '/api/yt.php'); ?>

  </body>
</html>
