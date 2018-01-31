<?php
  include('class.genAvatar.php');

  header("Content-type: image/png");

  if(isset($_GET['hash'])) {
    $hash = $_GET['hash'];
  } else {
    $hash = time();
  }

  $ga = new GenAvatar($hash);

  if(isset($_GET['color1']) && isset($_GET['color2']) && isset($_GET['size'])) {
    echo $ga->generate($_GET['size'], $_GET['color1'], $_GET['color2']);
  }
?>
